$(document).ready(function () {
    var id, horseID, raceID, i, j, rem, div, loginBox,rval;
/************************************************************\
*Popup arises on button click
\************************************************************/
    $('a.btn').live('click', function () {
		$('#odd,#amt,#mid').val('');
        id = $(this).closest("div");
        horseID = $(this).attr('id');
        raceID = $("#race").text();
        loginBox = $(this).attr('href');
		//insert previous odd amount in textbox
		$("input:radio[name=win_place]").click(function() {
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
				$('#amt,#mid').val('');
			}
        });
	});
	$('#mid').live('keypress',function (e) {
		$("#suggestion-text").fadeOut(1);
	});
	//call popup
        popup(loginBox, id);
        return false;
    });
/************************************************************\
*On done button click inside popup
\************************************************************/
    $('#done').live('click', function () {
	var mid=$('#mid').val().split(".");//splitting member name and their id
	if(!mid[1]) {
		var dataString = "&name=" + mid[0] + "&retrievePersonID=1";
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
			else
				$("#msg").html(data[0]).fadeIn(300).fadeOut(300);
			underlineName();
        });
        return false;
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
			$('input#oddsMobWin' + horse_id).focus();
            return false;
        });
		Mousetrap.bind('command+shift+' + val, function (e1) {
			window.flag=0;
			$("tr.oddsamtname").fadeOut();
			$("tr.oddsamtname1").fadeOut();
			$('input#oddsMobPlace' + horse_id).trigger('click');
			$('input#oddsMobPlace' + horse_id).closest("tr.oddsamtname1").show();
			$('input#oddsMobPlace' + horse_id).focus();
            return false;
        });
		}
		else if(BrowserDetect.OS=="Windows"){
        Mousetrap.bind('ctrl+' + val, function (e1) {
			window.flag=1;
			$("tr.oddsamtname").fadeOut();
			$("tr.oddsamtname1").fadeOut();
			$('input#oddsMobWin' + horse_id).trigger('click');
			$('input#oddsMobWin' + horse_id).closest("tr.oddsamtname").show();
			$('input#oddsMobWin' + horse_id).focus();
            return false;
        });
		Mousetrap.bind('ctrl+shift+' + val, function (e1) {
			window.flag=0;
			$("tr.oddsamtname").fadeOut();
			$("tr.oddsamtname1").fadeOut();
			$('input#oddsMobPlace' + horse_id).trigger('click');
			$('input#oddsMobPlace' + horse_id).closest("tr.oddsamtname1").show();
			$('input#oddsMobPlace' + horse_id).focus();
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
