$(document).ready(function () {

    $.post('bait.php', {
        retr: "1"
    }, function (data3) {
        data3 = jQuery.parseJSON(data3);
        len1 = data3.length;
        var j;
        $("<div id='individual' class='thumbnail'><table><tr><td>Race id: </td><td id='race'>123</td></tr></table><br><div id='display' class='customer'><tr><h1><p> Booked Customer Details </p></h1></tr></div></div>").appendTo("#page");
        for (j = 0; j < len1; j++) {//retreiving horse from DB 																																																													 /* baiting_person calls baited person from db */				/* inOut finds the profits and loss for the respective horse */
            $("<div id='vin" + (j + 1) + "' class='thumbnail'><tr><br><a id='" + data3[j].horse_number + "' href='#login-box' class='btn'>" + data3[j].horse_name + "</a></tr><tr><h4><p><td>Member</td><td>Odds</td><td>Bait</td></p></h4></tr><div id='display" + data3[j].horse_number + "' class='customer'>" + baiting_person('123', data3[j].horse_number) + "</div><hr>" + inOut('123', data3[j].horse_number) + "</div>").appendTo("#page");
            ctrlPlusKey(data3[j].horse_number, (j + 1));//assigning onkeypress for every horse by sending horse_numberand its id																																												 /* baiting_person calls baited person from db */				/* inOut finds the profits and loss for the respective horse */
        }
    });

});
/************************************************************\
*Retrieving baiting person details
\************************************************************/
function baiting_person(race_id, horse_id) {
    var dataString = "rid=" + race_id + "&hid=" + horse_id + "&retrb=1",
        bp = '',
        len, i, data1;
    $.ajax({
        url: 'bait.php',
        data: dataString,
        type: "POST",
        async: false,
        success: function (data2) {
            data1 = jQuery.parseJSON(data2);
            len = data1.length;
            for (i = 0; i < len; i++)//this finds the baiting person
            bp += "<div class='mob'><table><tr><h4><p><td>" + data1[i].name + " </td><td>" + data1[i].odds + "</td><td>" + data1[i].bait_amount + "&nbsp;</td></p></h4></tr></table></div>";
        }
    });
    return bp;
}
/************************************************************\
*Retrieving baiting profit&loss details
\************************************************************/
function inOut(race_id, horse_id) {
    var dataString = "rid=" + race_id + "&hid=" + horse_id + "&rinout=1",
        bp = '',
        data1;
    $.ajax({
        url: 'bait.php',
        data: dataString,
        type: "POST",
        async: false,
        success: function (data2) {
            data1 = jQuery.parseJSON(data2);//this find the profit and loss for the respective horse
            bp = "<div class='total'><h4><tr><td id='in'>Total Bait:</td><td>" + data1[0].total + "</td><td id='out'>&nbsp;&nbsp;Loss:</td><td>" + data1[0].out + "</td></tr></h4></div>";
        }
    });
    return bp;
}