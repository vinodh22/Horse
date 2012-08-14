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
        return false;
    });
/************************************************************\
*On done button click inside popup
\************************************************************/
    $('#done').live('click', function () {
        $.post('bait.php', {
            save: "1",
            odd: $('#odd').val(),
            amnt: $('#amt').val(),
            id: $('#mid').val(),
            hrnm: horseID,
            rid: raceID
        }, function (data) {
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

        Mousetrap.bind('esc', function (e) {
            $('a.close').trigger('click');
            console.log("esc");
            return false;
        });
        return false;
    });
});
/************************************************************\
*Popup arises onkeypress
\************************************************************/
function ctrlPlusKey(horse_id, val) {
    if (val <= 9) {
        //console.log("ctrlsingle"+(val)+":"+horse_id);
        Mousetrap.bind('ctrl+' + val, function (e1) {
            $('a#' + horse_id).trigger('click');
            //console.log("ctrlsingle"+val+":"+horse_id);
            return false;
        });
    }
    /* 
		else {
			rem=val%10;
			div=Math.floor(val/10);
			//console.log(rem+":"+div);
			Mousetrap.bind('ctrl+'+div+' ctrl+'+rem, function(e1) {
				$('a#'+horse_id).trigger('click');
				console.log(val+":"+rem+":"+div);
				return false;
			},keydown);
		}
		return; */
}
/************************************************************\
*Popup
\************************************************************/
function popup(loginBox, id) {
    $(loginBox).fadeIn(50);
    var pos = id.position();
    var popMargTop = pos.top + 30;
    var popMargLeft = pos.left + 40;
    $(loginBox).css({
        'top': popMargTop,
        'left': popMargLeft
    });
    $('body').append('<div id="mask"></div>');
    $('#mask').fadeIn(50);
}