$(document).ready(function () {
    var id, horseID, raceID, i, j, rem, div, loginBox;
/************************************************************\
*Popup arises on button click
\************************************************************/
    $('a.btn').live('click', function () {
        id = $(this).closest("div");
        horseID = $(this).attr('id');
        raceID = $("#race").text();
        loginBox = $(this).attr('href');
	//call popup
        popup(loginBox, id);
	//close popup on escape keypress
	Mousetrap.bind('esc', function() {$('a.close').trigger('click');return false; }, 'keyup');
        return false;
    });
/************************************************************\
*On done button click inside popup
\************************************************************/
    $('#done').live('click', function () {
	var mid=$('#mid').val().split(".");
        $.post('http://localhost/Horse/bait.php', {
            save: "1", //save triggers the function call in server side to save the bait details
            odd: $('#odd').val(),
            amnt: $('#amt').val(),
            id: mid[1],
            horseid: horseID,
            raceid: raceID
        }, function (data) {
			if(data=='true') {
				$("#display"+horseID).append("<div class='mob'><table><tr><h4><p><td>" + $('#odd').val() + " </td><td>" + $('#amt').val() + "</td><td>" + mid[0] + "&nbsp;</td></p></h4></tr></table></div>");
				$("div#inout"+horseID).html(inOut('123', horseID));
				$('a.close').trigger('click');
			}
			else
				$("#msg").html(data).fadeIn(300).fadeOut(500);
        });
        return false;
    });
/************************************************************\
*On close image button click inside popup, to close popup
\************************************************************/
    $('a.close, #mask').live('click', function () {
        $('#mask , .login-popup').fadeOut(50, function () {
            $('#mask').remove();
        });
        return false;
    });
});
/************************************************************\
*Popup arises onkeypress
\************************************************************/
function ctrlPlusKey(horse_id, val) {
    if (val <= 9) {
		if(BrowserDetect.OS=="Mac") {
		Mousetrap.bind('command+' + val, function (e1) {
            $('a#' + horse_id).trigger('click');
            return false;
        });
		}
		else if(BrowserDetect.OS=="Windows"){
        Mousetrap.bind('ctrl+' + val, function (e1) {
            $('a#' + horse_id).trigger('click');
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
    var popMargTop = pos.top + 20;
    var popMargLeft = pos.left + 40;
    $(loginBox).css({
        'top': popMargTop,
        'left': popMargLeft
    });
    $('body').append('<div id="mask"></div>');
    $('#mask').fadeIn(50);
}