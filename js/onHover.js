$(document).ready(function () {
    var memberID, baitID, horseID, raceID, id, sure, loginBox,hsplit,data='';
/************************************************************\
*Popup arises on mouseover
\************************************************************/
    $('tr.ontrhover').live('mouseenter',function () {
        id = $(this).closest("div");
		hsplit = $(this).attr('id').split("-");//splitting horse name and their id
        horseID = hsplit[0];
        raceID = hsplit[1];
		memberID = hsplit[2];
		baitID = hsplit[3];
        loginBox = $(this).attr('id');
	//call popup
        CrossTickAudiopopup("#cross-tick",id,$(this).position().top-$(id).position().top,175);
	/************************************************************\
	*On cross button click inside popup
	\************************************************************/
		$('a.cross').live('click', function () {
		var datastring = "baitid=" + baitID + "&deleteBait=1";
			console.log("Value of sure:"+sure);
			$.ajax({
				url: 'http://localhost/Horse/bait.php',
				data: datastring,
				//deleteBait triggers a function call in server side to delete bait details
				type: "POST",
				async: false,
				success: function (data) {
			data = jQuery.parseJSON(data);
			if(data!='') {
				CallMe_Win(horseID);
				CallMe_Place(horseID);
				return false;
			}
			}
			});
			$("#cross-tick").fadeOut(50);
		return false;
		});
	return false;
    });
	$('.thumbnail').live('mouseenter',function () {
	$("#cross-tick").fadeOut(50);
	});
/************************************************************\
*Popup arises on mouseover to add bait
\************************************************************/
	$('tr.oddsamtname td:nth-child(1)').live('click',function () {
	var win=window.flag;
		$('input.baitmob1,input.baitmob2,input.baitmob3').val('');
	var odd,amt;
        id = $(this).closest("div");
		//call popup
        //CrossTickAudiopopup("#add-bait",id,$(this).position().top,210);
		hsplit = $(this).closest("tr").attr('id').split("-");//splitting horse name and their id
        pophorseID = horseID = hsplit[2];
        raceID = hsplit[1];		
        loginBox = $(this).attr('class');
	//insert previous odd amount in textbox
		$.post('http://localhost/Horse/bait.php', {
            insertPrevious: "1", //inserts previous odd amount
			flag:1,
            horseid: horseID,
            raceid: $("#race").text()
        }, function (data1) {
			data = jQuery.parseJSON(data1);
			if(data!='') {
				$('input#oddsMobWin'+pophorseID).val(data[0].odds);
				$('input#oddsMobWin'+pophorseID).select();
				Mousetrap.bind('esc', function() { $('a.close').trigger('click');$("#add-bait").fadeOut(50);$("tr.oddsamtname").fadeOut(50);return false; }, 'keyup');
			}
        });
	//call autocomplete
		auto("input.baitmob3");
			$('input.baitmob1').live('blur',function() {
			odd=$(this).val();
			});
			$('input.baitmob2').live('blur',function() {
			amt=$(this).val();
			});
	//On clicking tick Image
		$('a.tick').die('click');
		$('a.tick').live('click', function () {
		if(!window.mid[1]) {
			var dataString = "&name=" + window.mid[0] + "&retrievePersonID=1";
			$.ajax({//retrievePersonID triggers the function call in server side to retrieve member ID
			url: 'http://localhost/Horse/person.php',
			data: dataString,
			type: "POST",
			async: false,
			success: function (datav) {
				data1 = jQuery.parseJSON(datav);
				window.mid[1]=data1[0].id;
			}
			});
		}
		$.post('http://localhost/Horse/bait.php', {
            save: "1", //save triggers the function call in server side to save the bait details
            odd: odd,
            amnt: amt,
			winplace: win,
            id: window.mid[1],//member ID
            horseid: horseID,
            raceid: raceID
        }, function (data) {
			data = jQuery.parseJSON(data);
			if(data.check=="true") {//onInsert 
				CallMe_Win(horseID);
			}
        });
		$('input.baitmob1,input.baitmob2,input.baitmob3').val('');			
			$("tr.oddsamtname").fadeOut(50);
		});
    });
	$('tr.oddsamtname1 td:nth-child(1)').live('click',function () {
	var win=window.flag;
		$$('input.baitmob11,input.baitmob22,input.baitmob33').val('');
	var odd,amt;
        id = $(this).closest("div");
		hsplit = $(this).closest("tr").attr('id').split("-");//splitting horse name and their id
        pophorseID = horseID = hsplit[2];
        raceID = hsplit[1];		
        loginBox = $(this).attr('class');
	//insert previous odd amount in textbox
		$.post('http://localhost/Horse/bait.php', {
            insertPrevious: "1", //inserts previous odd amount
			flag:0,
            horseid: horseID,
            raceid: $("#race").text()
        }, function (data1) {
			data = jQuery.parseJSON(data1);
			if(data!='') {
				$('input#oddsMobPlace'+pophorseID).val(data[0].odds);
				$('input#oddsMobPlace'+pophorseID).select();
				Mousetrap.bind('esc', function() { $('a.close').trigger('click');$("#add-bait").fadeOut(50);$("tr.oddsamtname1").fadeOut(50);return false; }, 'keyup');
			}
        });
	//call autocomplete
		auto("input.baitmob33");
			$('input.baitmob11').live('blur',function() {
			odd=$(this).val();
			});
			$('input.baitmob22').live('blur',function() {
			amt=$(this).val();
			});
	//On clicking tick Image but Image will not be displayed instead Triggered
		$('a.tick').die('click');
		$('a.tick').live('click', function () {
		if(!window.mid[1]) {
			var dataString = "&name=" + window.mid[0] + "&retrievePersonID=1";
			$.ajax({//retrievePersonID triggers the function call in server side to retrieve member ID
			url: 'http://localhost/Horse/person.php',
			data: dataString,
			type: "POST",
			async: false,
			success: function (datav) {
				data1 = jQuery.parseJSON(datav);
				window.mid[1]=data1[0].id;
			}
			});
		}
		$.post('http://localhost/Horse/bait.php', {
            save: "1", //save triggers the function call in server side to save the bait details
            odd: odd,
            amnt: amt,
			winplace: win,
            id: window.mid[1],//member ID
            horseid: horseID,
            raceid: raceID
        }, function (data) {
			data = jQuery.parseJSON(data);
			if(data.check=="true") {//onInsert 
				CallMe_Place(horseID);
			}
        });
		$$('input.baitmob11,input.baitmob22,input.baitmob33').val('');		
			$("tr.oddsamtname1").fadeOut(50);
		});
    });
});
/************************************************************\
*Popup
\************************************************************/
function CrossTickAudiopopup(pop,id,x,y) {
    $(pop).fadeIn(50);
    var pos = id.position();
    var popMargTop = pos.top + x;
    var popMargLeft = pos.left + y;
    $(pop).css({
        'top': popMargTop,
        'left': popMargLeft
    });
}