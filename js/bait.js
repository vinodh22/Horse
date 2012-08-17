$(document).ready(function () {
	var checkPerson='',checkInOut='';
    $.post('http://localhost/Horse/bait.php', {
        retrieveHorse: "1"//retrieveHorse triggers the function call in server side to retrieve the horse details
    }, function (data3) {
        data3 = jQuery.parseJSON(data3);
        len1 = data3.length;
        for (var j = 0; j < len1; j++) {//retreiving horse from DB
		/* baiting_person calls baiting person from db */
		checkPerson=baiting_person('123', data3[j].horse_number);
		/* inOut finds the profits and loss for the respective horse */
		checkInOut=inOut('123', data3[j].horse_number);
		if(checkPerson=='' && checkInOut=='')
			$("<div id='vin" + (j + 1) + "' class='thumbnail'><tr><br><a id='" + data3[j].horse_number + "' href='#login-box' class='btn'>" + data3[j].horse_name + "</a></tr><tr><h4><p><span id='mob1" + data3[j].horse_number + "' class='mobin'><td>Odds</td></span></span><span id='mob2" + data3[j].horse_number + "' class='mobin'><td>Amount</td></span><span id='mob3" + data3[j].horse_number + "' class='mobin'><td>Member</td></span></p></h4></tr></span><div id='display" + data3[j].horse_number + "' class='customer'></div><hr><div id='inout" + data3[j].horse_number + "'></div></div>").appendTo("#page");
		else {
            $("<div id='vin" + (j + 1) + "' class='thumbnail'><tr><br><a id='" + data3[j].horse_number + "' href='#login-box' class='btn'>" + data3[j].horse_name + "</a></tr><tr><h4><p><span id='mob1" + data3[j].horse_number + "' class='mobin'><td>Odds</td></span></span><span id='mob2" + data3[j].horse_number + "' class='mobin'><td>Amount</td></span><span id='mob3" + data3[j].horse_number + "' class='mobin'><td>Member</td></span></p></h4></tr></span><div id='display" + data3[j].horse_number + "' class='customer'>" + checkPerson + "</div><hr><div id='inout" + data3[j].horse_number + "'>" + checkInOut + "</div></div>").appendTo("#page");
            ctrlPlusKey(data3[j].horse_number, (j + 1));//assigning onkeypress for every horse by sending horse_numberand its id
			}
        }
    });
});
/************************************************************\
*Retrieving baiting person details
\************************************************************/
function baiting_person(race_id, horse_id) {
    var dataString = "raceid=" + race_id + "&horseid=" + horse_id + "&retrievePerson=1",bp = '',len, i, data1;
    $.ajax({//retrievePerson triggers the function call in server side to retrieve the baiting person details
        url: 'http://localhost/Horse/bait.php',
        data: dataString,
        type: "POST",
        async: false,
        success: function (data2) {
            data1 = jQuery.parseJSON(data2);
			if(data1!='') {
            len = data1.length;
            for (i = 0; i < len; i++)//this finds the baiting person
            bp += "<div class='mob'><table><tr><h4><p><td>" + data1[i].odds + " </td><td>" + data1[i].bait_amount + "</td><td>" + data1[i].name + "&nbsp;</td></p></h4></tr></table></div>";
			}
			else
			bp='';
        }
    });
    return bp;
}
/************************************************************\
*Retrieving baiting profit&loss details
\************************************************************/
function inOut(race_id, horse_id) {
    var dataString = "raceid=" + race_id + "&horseid=" + horse_id + "&raceinout=1",bp = '',data1;
    $.ajax({//raceinout triggers the function call in server side to retrieve the profit & loss details for the respective horse
        url: 'http://localhost/Horse/bait.php',
        data: dataString,
        type: "POST",
        async: false,
        success: function (data2) {
		data1 = jQuery.parseJSON(data2);//this find the profit and loss for the respective horse
			if(data1!='')
			bp = "<div class='total'><h4><tr><td class='in'>Total:</td><span id='mob4"+horse_id+"' class='mobin'><td>" + data1[0].total + "</td></span><td calss='out'> Loss:</td><span id='mob5"+horse_id+"' class='mobin'><td>" + data1[0].out + "</td></span></tr></h4></div>";
			else
			bp = "<div class='total'><h4><tr><td class='in'>Total:</td><span id='mob4"+horse_id+"' class='mobin'><td>0</td></span><td calss='out'> Loss:</td><span id='mob5"+horse_id+"' class='mobin'><td>0</td></span></tr></h4></div>";
		}
    });
    return bp;
}