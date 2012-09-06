<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0//EN">
<head>
<title>
Start Bait !
</title>
<link href="css/jquery-ui-1.8.23.custom.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<?php
$sel=$_POST['rsel'];
if($sel!=0) {
$dat=explode( '-', $sel );
echo "<div id='bookeddetails'><center><span id='raceid' class='profitloss'><table><tr><span id='bookedmember'><p> Booked Customer Details </p></span></tr><tr><td>Race: </td><td id='race'>".$dat[0]."</td><td>Time: </td><td id='raceTime'>".$dat[1]."</td></tr></table></span></center></div>";
}
else {
echo "Sorry Select the RaceID";
}
?>
<link href="css/popup.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bait.js"></script>
<script type="text/javascript" src="js/popup.js"></script>
<script type="text/javascript" src="js/onHover.js"></script>
<script type="text/javascript" src="js/mousetrap.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.23.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.ui.autocomplete.js"></script>
<script type="text/javascript" src="js/browserDetect.js"></script>
<script type="text/javascript">
$(document).ready(function () {
	auto("#mid");
	window.flag=0;
	window.mid=[];
});
function auto(id) {
var src,key='',lft=20;
var arr,txt='';
$(id).die('keydown');
$(id).live('keydown',function (e) {
	if(e.keyCode==39){
		$(this).val($("a.ui-corner-all:first").text());
		$("#suggestion-text").fadeOut(50);
		}
	if(e.keyCode==37)
		$("#suggestion-text").fadeOut(50);
	if(e.keyCode==8) {
	if($(this).val().length==0){
		txt='';
		$("#suggestion-text").html("<p>"+txt+"</p>");
		$("#suggestion-text").fadeOut(50);
		arr=[];
		}
	}
	if($(this).val().length==0){
		$("#suggestion-text").fadeOut(50);
		arr=[];
		}
	$( id ).autocomplete({
		source:arr,
		});
		arr=[];
	});
	if($(id).val().length==0){
		$("#suggestion-text").fadeOut(50);
		arr=[];
		}
$(id).die('keypress');
$(id).live('keypress',function (e) {
		arr = [];
		if(e.keyCode==13 || e.keyCode==9){
		arr = [];
		$("#suggestion-text").fadeOut();
		window.mid=$(this).val().split(".");//splitting member name and their id
		$('a.tick').trigger('click');
		}
		key=this.value + String.fromCharCode(e.keyCode);
		var dataString = "autoname=true&req="+key;
		var len=0,qury='';
		qury=$("a.ui-corner-all:first").text();
		len=qury.length;
		if(key=='' || $(this).val()=='') {
		txt='';
		$("#suggestion-text").html("<p>"+txt+"</p>");
		$("#suggestion-text").fadeOut(50);
		arr=[];
		}
		else
		txt=qury.substring(key.length,len);
		if(e.keyCode==8) {
			if($(this).val().length==0){
				txt='';
				$("#suggestion-text").html("<p>"+txt+"</p>");
				$("#suggestion-text").fadeOut(50);
				arr=[];
				}
		}
		$("#suggestion-text").html("<p>"+txt+"</p>");
			var pos = $(this).position();
			var popMargTop = pos.top+8;
			var popMargLeft = pos.left-5+(lft++);
			$("#suggestion-text").css({
			'top': popMargTop,
			'left': popMargLeft,
			'opacity':0.8,
			'width':((len-key.length-1)*5)+'px'
			});
			$("#suggestion-text p").css({
			'margin-top':-2+'px'
			});
		if(key!='') {
		$.ajax({
        url: 'bait.php',
        data: dataString,
        type: "POST",
        async: false,
        success: function (data2) {
            src = jQuery.parseJSON(data2);//this finds the member name and id for auto complete
			arr=[];
			for (i in src)
				arr[i]=src[i].name+"."+src[i].id;
			if(arr!='')
			$("#suggestion-text").fadeIn();
			else
			$("#suggestion-text").fadeOut(50);
			$( id ).autocomplete({
			source:arr,
		});
		arr=[];
        }
		});
		}
		});
	}
</script>
</head>

<body>
<form action="bait.php" method="post" id="baitForm">
<center>
<div id="page">

</div>
</center>
</form>
<div id="login-box" class="login-popup">
        <a href="#" class="close"><img src="close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
          <form method="post" class="pop" action="bait.php" id="popForm">
          <center><div id="msg" style="display:none;color:red"></div></center>
                <fieldset class="textbox">
				<label class="Win">
                <table><tr>Win:<input id="win" name="win_place" value="1" type="radio" style="width: 40px;">Place:<input id="place" name="win_place" value="0" type="radio"  style="width: 40px;"></tr></table>
                </label>
            	<label class="Odds">
                <input id="odd" type="text" placeholder="Odds">
                </label>
                <label class="Amount">
                <input id="amt" type="text" placeholder="Amount">
                </label>
                <label class="Member ID">
                <input id="mid" type="text" placeholder="Name">
                </label>
                <button class="submit button" id="done" type="button">Done !</button>
                </fieldset>
          </form>
</div>
<div id="cross-tick" class="popup1">
    <form method="post" class="pop" action="bait.php" id="tcForm">
        <table><tr>
		<td><a id="crosstd" href="#" class="cross"><img id="tick" src="cross.gif" class="btn_close1" title="Delete" alt="Close" /></a></td>
		<td><a id="audiotd" href="#" class="audio"><img src="audio.gif" class="btn_close1" title="Audio" alt="Close" /></a></td>
		</tr></table>
    </form>
</div>
<div id="add-bait" class="popup2">
    <form method="post" class="pop" action="bait.php" id="tcForm">
        <table><tr>
		<td><a id="crosstd" href="#" class="tick"></a></td>
		</tr></table>
    </form>
</div>
<div id="suggestion-text" class="popup3">
		<p id="suggest"></p>
</div>
</body>
</html>