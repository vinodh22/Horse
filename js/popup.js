$(document).ready(function () {
    var id, horseID, raceID, i, j, rem, div, loginBox,rval;
/************************************************************\
*Popup arises on button click
\************************************************************/
    $('a.btn').live('click', function () {
	$('#cross-tick').fadeOut(100);
		$('#odd,#amt,#mid').val('');
        id = $(this).closest("div");
        horseID = $(this).attr('id');
        raceID = $("#race").text();
        loginBox = $(this).attr('href');
		$("tr.oddsamtname").fadeOut(50);
		$("tr.oddsamtname1").fadeOut(50);
		$('input[name="win_place"]')[0].checked = false;
		$('input[name="win_place"]')[1].checked = false;
		//insert previous odd amount in textbox
		$("input:radio[name=win_place]").click(function() {
		$('#odd').val("");
		rval = $(this).val();
		$.post('../bait.php', {
            insertPrevious: "1", //inserts previous odd amount
			flag:rval,
            horseid: horseID,
            raceid: raceID
        }, function (data1) {
			data = jQuery.parseJSON(data1);
			if(data!='') {
				$('#odd').val(data[0].odds);
				$('#odd').select();
			}
        });
	});
	
	//call popup
	popup(loginBox, id);
        return false;
    });
/************************************************************\
*On done button click inside popup
\************************************************************/
	$('#done').die('click');
    $('#done').live('click', function () {
	var mid=$('#mid').val().trim().split(":"),fine=3;//splitting member name and their id
	if( (!$('#odd').val().trim().match(/^[0-9]*\.[0-9]+$/g))) {
		fine--;
		if(($('#odd').val().trim()>=1 || $('#odd').val().trim()<=0) ){
			fine--;
			$('#odd').val('');
			$("#msg").html("<p style='color:red'>Check Odd</p>").show().fadeOut(1000);
			return;
		}
		else {
			fine--;
			$('#odd').val('');
			$("#msg").html("<p style='color:red'>Check Odd</p>").show().fadeOut(1000);
			return;
		}
	}
	else {
		if(($('#odd').val().trim()>=1 || $('#odd').val().trim()<=0) ){
		fine--;
		$('#odd').val('');
		$("#msg").html("<p style='color:red'>Check Odd</p>").show().fadeOut(1000);
		return;
		}
	}
	if((!$('#amt').val().trim().match(/^[0-9]+$/g))) {
		fine--;
		$('#amt').val('');
		$("#msg").html("<p style='color:red'>Check Bet Amount</p>").show().fadeOut(1000);
		return;
	}
	else {
		if(($('#amt').val().trim()<1)){
		fine--;
		$('#amt').val('');
		$("#msg").html("<p style='color:red'>Check Bet Amount</p>").show().fadeOut(1000);
		return;
		}
	}
	if((mid) ) {
		if(!$('#mid').val().trim().match(/^[0-9]*[0-9]*([0-9]\.)*[a-zA-Z]+$/g)){
			if(!$('#mid').val().match(/^[0-9]*[0-9]*([0-9]\.)*[a-zA-Z]+:[0-9]+$/g)){
				fine--;
				$('#mid').val('');
				$("#msg").html("<p style='color:red'>Check Member</p>").show().fadeOut(1000);
				return;
			}
		}
	}
	else {
		$("#msg").html("<p style='color:red'>Check Member</p>").show().fadeOut(1000);
		return;
	}
	if(!($('input[name="win_place"]')[0].checked || $('input[name="win_place"]')[1].checked)) {
		fine--;
		$("#msg").html("<p style='color:red'>Select RadioButton</p>").show().fadeOut(1000);
		return;
	}
		if(fine==3) {
		var find="pid="+mid[1]+"&pname="+mid[0],found=2;
			if(mid[1]) {
				$.ajax({//retrievePerson triggers the function call in server side to retrieve the baiting person details
				url: '../person.php',
				data:find,
				type: "POST",
				async: false,
				success: function (data) {
				if(data=="not found"){
					found=1;
				}
				else if(data=="found"){
					found=2;
				}
				}
				});
				if(found==2) {
					if(!mid[1]) {
						var dataString = "name=" + mid + "&retrievePersonID=1";
						$.ajax({//updatePersonID triggers the function call in server side to member name
						url: '../person.php',
						data: dataString,
						type: "POST",
						async: false,
						success: function (data) {
							data1 = jQuery.parseJSON(data);
							mid[1]=data1[0].id;
						}
						});
						//alert(mid[1]);
						}
						$.post('../bait.php', {
							save: "1", //save triggers the function call in server side to save the bait details
							odd: $('#odd').val(),
							amnt: $('#amt').val(),
							id: mid[1],//member ID
							winplace: rval,
							horseid: horseID,
							raceid: raceID
						}, function (data) {
							data = jQuery.parseJSON(data);
							if(data.check=="true") {//onInsert
								if(rval==1) {
									CallMe_Win(horseID);
								}
								else {
									CallMe_Place(horseID);
								}
								$('a.close').trigger('click');
								$('#odd,#amt,#mid').val('');
							}
						});
						return false;
				}
				else {
					$('#mid').val('');
					$("#msg").html("<p style='color:red'>Check Member</p>").show().fadeOut(1000);
				}
			}
			else {
				if(!mid[1]) {
					var dataString = "name=" + mid + "&retrievePersonID=1";
					$.ajax({//updatePersonID triggers the function call in server side to member name
					url: '../person.php',
					data: dataString,
					type: "POST",
					async: false,
					success: function (data) {
						data1 = jQuery.parseJSON(data);
						mid[1]=data1[0].id;
					}
					});
					//alert(mid[1]);
					}
					$.post('../bait.php', {
						save: "1", //save triggers the function call in server side to save the bait details
						odd: $('#odd').val(),
						amnt: $('#amt').val(),
						id: mid[1],//member ID
						winplace: rval,
						horseid: horseID,
						raceid: raceID
					}, function (data) {
						data = jQuery.parseJSON(data);
						if(data.check=="true") {//onInsert
							if(rval==1) {
								CallMe_Win(horseID);
							}
							else {
								CallMe_Place(horseID);
							}
							$('a.close').trigger('click');
							$('#odd,#amt,#mid').val('');
						}
					});
					return false;
			}
		}
    });
/************************************************************\
*On close image button click inside popup, to close popup
\************************************************************/
		$('a.close').live('click', function () {
			$('.login-popup').fadeOut(50, function () {
			});
			return false;
		});
	//close popup on escape keypress
	Mousetrap.bind('esc', function() { $('a.close').trigger('click');$("#add-bait").fadeOut(50);$("tr.oddsamtname").fadeOut(50);$('input.baitmob3').focusout();return false; }, 'keyup');
});
/************************************************************\
*Popup arises onkeypress
\************************************************************/
function ctrlPlusKey(horse_id) {
	var val=horse_id,len=numLength(val);
    if (len == 1) {
		if(BrowserDetect.OS=="Mac") {
		Mousetrap.bind('command+' + val, function (e1) {
			window.flag=1;
			$("tr.oddsamtname").fadeOut();
			$("tr.oddsamtname1").fadeOut();
			$('input#oddsMobWin' + horse_id).trigger('click');
			$('input#oddsMobWin' + horse_id).closest("tr.oddsamtname").show();
            return false;
        });
		Mousetrap.bind('command+shift+' + val, function (e1) {
			window.flag=0;
			$("tr.oddsamtname").fadeOut();
			$("tr.oddsamtname1").fadeOut();
			$('input#oddsMobPlace' + horse_id).trigger('click');
			$('input#oddsMobPlace' + horse_id).closest("tr.oddsamtname1").show();
            return false;
        });
		}
		else if(BrowserDetect.OS=="Windows"){
        Mousetrap.bind('ctrl+' + val, function (e1) {
			window.flag=1;
			$("tr.oddsamtname").fadeOut();
			$("tr.oddsamtname1").fadeOut();
			$('input#oddsMobWin' + horse_id).trigger('click');
			$('input#oddsMobWin' + horse_id).closest("tr.oddsamtname").show(100);
            return false;
        });
		Mousetrap.bind('ctrl+shift+' + val, function (e1) {
			window.flag=0;
			$("tr.oddsamtname").fadeOut();
			$("tr.oddsamtname1").fadeOut();
			$('input#oddsMobPlace' + horse_id).trigger('click');
			$('input#oddsMobPlace' + horse_id).closest("tr.oddsamtname1").show(100);
			return false;
        });
		}
    }
}
/************************************************************\
*Popup
\************************************************************/
function popup(loginBox, id) {
    $(loginBox).fadeIn(50);
    var pos = id.position();
    var popMargTop = pos.top + 35;
    var popMargLeft = pos.left + 25;
    $(loginBox).css({
        'top': popMargTop,
        'left': popMargLeft
    });
}
/************************************************************\
*To find the length of a number
\************************************************************/
function numLength(x) {
var i=0;
	while(x>0) {
		x=Math.floor(x/10);
		i++;
	}
	return i;
}
