$(document).ready(function () {
//console.log(window.raceID+":"+window.racingTime);
	startBait();//retrieve all bait details
});
/************************************************************\
*Retrieving All baiting details
\************************************************************/
function startBait() {
var checkPerson='',checkPerson1='',checkInOut='',checkInOut1='',pageAppend='';
    $.post('../bait.php', {
        retrieveHorse: "1",//retrieveHorse triggers the function call in server side to retrieve the horse details
		raceid:$("#race").text()
    }, function (data3) {
        data3 = jQuery.parseJSON(data3);
        len1 = data3.length;
        for (var j = 0; j < len1; j++) {//retreiving horse from DB
		/* baiting_person calls baiting person from db */
		checkPerson=baiting_person($("#race").text(), data3[j].horse_number,1);
		checkPerson1=baiting_person($("#race").text(), data3[j].horse_number,0);
		/* inOut finds the profits and loss for the respective horse */
		checkInOut=inOut($("#race").text(), data3[j].horse_number,1);
		checkInOut1=inOut($("#race").text(), data3[j].horse_number,0);
		if(checkPerson=='' && checkInOut=='' && checkPerson1=='' && checkInOut1=='')
			pageAppend+="<div id='vin" + (j + 1) + "' class='thumbnail'><tr><td><a id='" + data3[j].horse_number + data3[j].horse_name + "'class='btn' onclick='this.disabled=true'>" + data3[j].horse_number + "</a></td><td><a id='" + data3[j].horse_number + "' href='#login-box' class='btn'>" + data3[j].horse_name + "</a></td></tr><div id='displayWin" + data3[j].horse_number + "' class='customer'></div><hr><div class='total' id='inoutWin" + data3[j].horse_number + "'></div><div id='displayPlace" + data3[j].horse_number + "' class='customer1'></div><hr><div class='total' id='inoutPlace" + data3[j].horse_number + "'></div></div>";
		else {
			pageAppend+="<div id='vin" + (j + 1) + "' class='thumbnail'><tr><td><a id='" + data3[j].horse_number + data3[j].horse_name + "'class='btn' onclick='this.disabled=true'>" + data3[j].horse_number + "</a></td><td><a id='" + data3[j].horse_number + "' href='#login-box' class='btn'>" + data3[j].horse_name + "</a></td></tr><div id='displayWin" + data3[j].horse_number + "' class='customer'>" + checkPerson + "</div><div class='total' id='inoutWin" + data3[j].horse_number + "'>" + checkInOut + "</div><hr style='margin-top:-15px;'><div id='displayPlace" + data3[j].horse_number + "' class='customer1'>" + checkPerson1 + "</div><hr style='margin-top:5px;margin-bottom:10px;'><div class='total' id='inoutPlace" + data3[j].horse_number + "'>" + checkInOut1 + "</div></div>";            
            ctrlPlusKey(data3[j].horse_number);//assigning onkeypress for every horse by sending horse_numberand its id
			}
        }
		$("#page").html(pageAppend);
		underlineName();
    });
}
/************************************************************\
*Retrieving baiting person details
\************************************************************/
function baiting_person(race_id1, horse_id1,wp) {
    var dataString = "raceid=" + race_id1 + "&horseid=" + horse_id1 + "&w_or_p=" + wp +"&retrievePerson=1",bp = '<table>',len, i, data1;
    $.ajax({//retrievePerson triggers the function call in server side to retrieve the baiting person details
        url: '../bait.php',
        data: dataString,
        type: "POST",
        async: false,
        success: function (data2) {
            data1 = jQuery.parseJSON(data2);
			if(data1!='') {
            len = data1.length;
			var strid='';
            for (i = 0; i < len; i++) {//this finds the baiting person
			strid=horse_id1 +"-"+ race_id1 +"-"+ data1[i].pid +"-"+ data1[i].bid;
			if(wp==1) {
				bp += "<tr class='ontrhover' id='"+ strid +"'><td class='mobodds' contenteditable='true'>" + data1[i].odds + "</td><td class='mobbait' contenteditable='true'>" + data1[i].bait_amount + "</td><td class='mobmid' contenteditable='true'>" + data1[i].name + "</td></tr>";
			}
			else {
				bp += "<tr class='ontrhover' id='"+ strid +"'><td class='mobodds1' contenteditable='true'>" + data1[i].odds + "</td><td class='mobbait1' contenteditable='true'>" + data1[i].bait_amount + "</td><td class='mobmid1' contenteditable='true'>" + data1[i].name + "</td></tr>";
			}
			}
			if(wp==1)
			bp+="</table><table><tr id='addBaitWin-"+race_id1+"-"+horse_id1+"' class='oddsamtname'><td><input id='oddsMobWin"+horse_id1+"' class='baitmob1' type='text'></td><td><input class='baitmob2' type='text'></td><td><input class='baitmob3' type='text'></td></tr></span></table>";
			else
			bp+="</table><table><tr id='addBaitPlace-"+race_id1+"-"+horse_id1+"' class='oddsamtname1'><td><input id='oddsMobPlace"+horse_id1+"' class='baitmob11' type='text'></td><td><input class='baitmob22' type='text'></td><td><input class='baitmob33' type='text'></td></tr></span></table>";
			}
			else {
				if(wp==1)
				bp+="</table><table><tr id='addBaitWin-"+race_id1+"-"+horse_id1+"' class='oddsamtname'><td><input id='oddsMobWin"+horse_id1+"' class='baitmob1' type='text'></td><td><input class='baitmob2' type='text'></td><td><input class='baitmob3' type='text'></td></tr></span></table>";
				else
				bp+="</table><table><tr id='addBaitPlace-"+race_id1+"-"+horse_id1+"' class='oddsamtname1'><td><input id='oddsMobPlace"+horse_id1+"' class='baitmob11' type='text'></td><td><input class='baitmob22' type='text'></td><td><input class='baitmob33' type='text'></td></tr></span></table>";
			}
        }
    });
    return bp;
}
/************************************************************\
*Retrieving baiting profit&loss details
\************************************************************/
function inOut(race_id2, horse_id2,wp) {
    var dataString = "raceid=" + race_id2 + "&horseid=" + horse_id2 + "&w_or_p=" + wp + "&raceinout=1",bp = '',data1;
    $.ajax({//raceinout triggers the function call in server side to retrieve the profit & loss details for the respective horse
        url: '../bait.php',
        data: dataString,
        type: "POST",
        async: false,
        success: function (data2) {
		data1 = jQuery.parseJSON(data2);//this find the profit and loss for the respective horse
		if(wp==1) {
			if(data1!='') {
				var risk=data1[0].winc-data1[0].out;
				var single_risk=data1[0].out-data1[0].total;
				var ao=Math.floor((single_risk/data1[0].total)*100)/100;
				if(ao==0 || single_risk==0) {
					data1[0].total=0;
					data1[0].out=0;
					risk=0;
					ao=0;
				}
				bp = "<h5><span class='cprao'> C:</span><span class='mobin'>" + data1[0].total + "</span><span class='cprao'> P:</span><span class='mobin'>" + data1[0].out + "</span><span class='cprao'> R:</span><span class='mobin'>"+risk+"</span><span class='cprao'> A.O:</span><span class='mobin'>"+ao+"</span></h5>";
			}
			else
				bp = "<h5><span class='cprao'>C:</span><span class='mobin'>0</span><span class='cprao'> P:</span><span class='mobin'>0</span><span class='cprao'> R:</span><span class='mobin'>0</span><span class='cprao'> A.O:</span><span class='mobin'>0</span></h5>";
		}
		else {
			if(data1!='') {
				var risk=data1[0].placec-data1[0].out;
				var single_risk=data1[0].out-data1[0].total;
				var ao=Math.floor((single_risk/data1[0].total)*100)/100;
				if(ao==0 || single_risk==0) {
					data1[0].total=0;
					data1[0].out=0;
					risk=0;
					ao=0;
				}
				bp = "<h5><span class='cprao'> C:</span><span class='mobin'>" + data1[0].total + "</span><span class='cprao'> P:</span><span class='mobin'>" + data1[0].out + "</span><span class='cprao'> R:</span><span class='mobin'>"+risk+"</span><span class='cprao'> A.O:</span><span class='mobin'>"+ao+"</span></h5>";
			}
			else
				bp = "<h5><span class='cprao'>C:</span><span class='mobin'>0</span><span class='cprao'> P:</span><span class='mobin'>0</span><span class='cprao'> R:</span><span class='mobin'>0</span><span class='cprao'> A.O:</span><span class='mobin'>0</span></h5>";
		}
		}
    });
    return bp;
}
function riskOnAllHorse() {

}
/************************************************************\
*Updating baiting odds
\************************************************************/
$('td.mobodds').live('blur',function() {
	if(($(this).text().trim().match(/^[0-9]*\.[0-9]+$/g)) && ($(this).text().trim()<1 && $(this).text().trim()>0)){
	//alert((parseInt($(this).text().trim())+5)+":"+parseInt($(this).text().trim()));
		moboddsLive(1,$(this));
	}
	else {
		CrossTickAudiopopup("#suggestion-odds",$(this).closest("div"),($(this).closest("table").position().top-$(this).closest("div").position().top)+70,15);
		document.execCommand('undo', false, null);
		setTimeout(function(){$("#suggestion-odds").fadeOut()},1000);
	}
});
$('td.mobodds1').live('blur',function() {
	if(($(this).text().trim().match(/^[0-9]*\.[0-9]+$/g)) && ($(this).text().trim()<1 && $(this).text().trim()>0)){
		moboddsLive(0,$(this));
	}
	else {
		CrossTickAudiopopup("#suggestion-odds",$(this).closest("div"),($(this).closest("table").position().top-$(this).closest("div").position().top)+70,15);
		document.execCommand('undo', false, null);
		setTimeout(function(){$("#suggestion-odds").fadeOut()},1000);
	}
});
$('td.mobodds').live('keypress',function(e) {
	if(e.keyCode==13 || e.keyCode==9){
		if(($(this).text().trim().match(/^[0-9]*\.[0-9]+$/g)) && ($(this).text().trim()<1 && $(this).text().trim()>0)){
			moboddsLive(1,$(this));
		}
		else {
			CrossTickAudiopopup("#suggestion-odds",$(this).closest("div"),($(this).closest("table").position().top-$(this).closest("div").position().top)+70,15);
			document.execCommand('undo', false, null);
			setTimeout(function(){$("#suggestion-odds").fadeOut()},1000);
		}
	}
});
$('td.mobodds1').live('keypress',function(e) {
	if(e.keyCode==13 || e.keyCode==9){
		if(($(this).text().trim().match(/^[0-9]*\.[0-9]+$/g)) && ($(this).text().trim()<1 && $(this).text().trim()>0)){
			moboddsLive(0,$(this));
		}
		else {
			CrossTickAudiopopup("#suggestion-odds",$(this).closest("div"),($(this).closest("table").position().top-$(this).closest("div").position().top)+70,15);
			document.execCommand('undo', false, null);
			setTimeout(function(){$("#suggestion-odds").fadeOut()},1000);
		}
	}
});
/************************************************************\
*Updating baiting amount
\************************************************************/
$('td.mobbait').live('blur',function() {
	if(($(this).text().trim().match(/^[0-9]+$/g)) && ($(this).text().trim())>0){
		mobbaitLive(1,$(this));
	}
	else {
		CrossTickAudiopopup("#suggestion-bait",$(this).closest("div"),($(this).closest("table").position().top-$(this).closest("div").position().top)+70,60);
		document.execCommand('undo', false, null);
		setTimeout(function(){$("#suggestion-bait").fadeOut()},1000);
	}
});
$('td.mobbait1').live('blur',function() {
	if(($(this).text().trim().match(/^[0-9]+$/g)) && ($(this).text().trim())>0){
		mobbaitLive(0,$(this));
	}
	else {
		CrossTickAudiopopup("#suggestion-bait",$(this).closest("div"),($(this).closest("table").position().top-$(this).closest("div").position().top)+70,60);
		document.execCommand('undo', false, null);
		setTimeout(function(){$("#suggestion-bait").fadeOut()},1000);
	}
});
$('td.mobbait').live('keypress',function(e) {
if(e.keyCode==13 || e.keyCode==9){
		if(($(this).text().trim().match(/^[0-9]+$/g)) && ($(this).text().trim())>0){
			mobbaitLive(1,$(this));		
		}
		else {
			CrossTickAudiopopup("#suggestion-bait",$(this).closest("div"),($(this).closest("table").position().top-$(this).closest("div").position().top)+70,60);
			document.execCommand('undo', false, null);
			setTimeout(function(){$("#suggestion-bait").fadeOut()},1000);
		}
	}
});
$('td.mobbait1').live('keypress',function(e) {
	if(e.keyCode==13 || e.keyCode==9){
		if(($(this).text().trim().match(/^[0-9]+$/g)) && ($(this).text().trim())>0){
			mobbaitLive(0,$(this));
		}
		else {
			CrossTickAudiopopup("#suggestion-bait",$(this).closest("div"),($(this).closest("table").position().top-$(this).closest("div").position().top)+70,60);
			document.execCommand('undo', false, null);
			setTimeout(function(){$("#suggestion-bait").fadeOut()},1000);
		}
	}
});
/************************************************************\
*Updating member name
\************************************************************/
$('td.mobmid').live('blur',function() {
	document.execCommand('undo', false, null);
});
$('td.mobmid1').live('blur',function() {
	document.execCommand('undo', false, null);
});
$('td.mobmid').live('keypress',function(e) {
	if(e.keyCode==13 || e.keyCode==9) {
		if(($(this).text().trim().match(/^[0-9]*[0-9]*([0-9]\.)*[a-zA-Z]+$/g)) || ($(this).text().match(/^[0-9]*[0-9]*([0-9]\.)*[a-zA-Z]+:[0-9]$/g))){
			mobmidLive(1,$(this));
		}
		else {
			CrossTickAudiopopup("#suggestion-name",$(this).closest("div"),($(this).closest("table").position().top-$(this).closest("div").position().top)+70,125);
			document.execCommand('undo', false, null);
			setTimeout(function(){$("#suggestion-name").fadeOut()},1000);
		}
	}
});
$('td.mobmid1').live('keypress',function(e) {
	if(e.keyCode==13 || e.keyCode==9) {
		if(($(this).text().trim().match(/^[0-9]*[0-9]*([0-9]\.)*[a-zA-Z]+$/g)) || ($(this).text().match(/^[0-9]*[0-9]*([0-9]\.)*[a-zA-Z]+:[0-9]$/g))){
			mobmidLive(0,$(this));
		}
		else {
			CrossTickAudiopopup("#suggestion-name",$(this).closest("div"),($(this).closest("table").position().top-$(this).closest("div").position().top)+70,125);
			document.execCommand('undo', false, null);
			setTimeout(function(){$("#suggestion-name").fadeOut()},1000);
		}
	}
});

/************************************************************\
*Displaying bait,collection,Payment,Risk & Avg.odds details
\************************************************************/
function CallMe_Win(hsplit) {
	$("div#displayWin"+hsplit).html(baiting_person($("#race").text(), hsplit,1));//display member
	$("div#inoutWin"+hsplit).html(inOut($("#race").text(), hsplit,1));//onInsert change PayIn & PayOut
	underlineName();
}
function CallMe_Place(hsplit) {
	$("div#displayPlace"+hsplit).html(baiting_person($("#race").text(), hsplit,0));//display member
	$("div#inoutPlace"+hsplit).html(inOut($("#race").text(), hsplit,0));//onInsert change PayIn & PayOut
	underlineName();
}

/************************************************************\
*Ajax call to update Odds
\************************************************************/
function moboddsLive(x,y) {
  var hsplit = $(y).closest("tr").attr('id').split("-");
  var dataString = "bid=" + hsplit[3] + "&odds=" + $(y).text() + "&updateOdds=1";
  
    $.ajax({//updateOdds triggers the function call in server side to update odds
        url: '../bait.php',
        data: dataString,
        type: "POST",
        async: false,
        success: function (data) {
		if(x==1) {
		CallMe_Win(hsplit[0]);
		return;
		}
		else {
		CallMe_Place(hsplit[0]);
		return;
		}
		}
    });
}

/************************************************************\
*Ajax call to update  Bait Amount
\************************************************************/
function mobbaitLive(x,y) {
var hsplit = $(y).closest("tr").attr('id').split("-");
  var dataString = "bid=" + hsplit[3] + "&amount=" + $(y).text() + "&updateAmount=1";
    $.ajax({//updateAmount triggers the function call in server side to update bait amount
        url: '../bait.php',
        data: dataString,
        type: "POST",
        async: false,
        success: function (data) {
		if(x==1) {
		CallMe_Win(hsplit[0]);
		return;
		}
		else {
		CallMe_Place(hsplit[0]);
		return;
		}
		}
    });
}

/************************************************************\
*Ajax call to update Member Name
\************************************************************/
function mobmidLive(x,y) {
auto(y);
  var hsplit = $(y).closest("tr").attr('id').split("-");
  var dataString = "pid=" + hsplit[2] + "&name=" + $(y).text() + "&retrievePersonID=1";
    $.ajax({//updatePerson triggers the function call in server side to member name
        url: '../person.php',
        data: dataString,
        type: "POST",
        async: false,
        success: function (data) {
		data1 = jQuery.parseJSON(data);
		var dataString1 = "idold=" + hsplit[2] + "&idnew=" + data1[0].id + "&horseid=" + hsplit[0] + "&odd="+$(y).prev().prev().text()+"&amt="+$(y).prev().text()+"&raceid=" + hsplit[1] + "&updateMemberID=1";
    $.ajax({//updateMemberID triggers the function call in server side to update Member ID
        url: '../bait.php',
        data: dataString1,
        type: "POST",
        async: false,
        success: function (data) {
		if(x==1) {
		CallMe_Win(hsplit[0]);
		return;
		}
		else {
		CallMe_Place(hsplit[0]);
		return;
		}
		}
		});
		}
    });
}
/************************************************************\
*To underline the Customer Name starts with number
\************************************************************/
function underlineName() {
$("tr.ontrhover td.mobmid,tr.ontrhover td.mobmid1").each(function(data){
			if($(this).text().match(/^\d.*$/i)) {
				$(this).css({
				'text-decoration':'underline',
				'color':'red'
				});
			}
		});
}
