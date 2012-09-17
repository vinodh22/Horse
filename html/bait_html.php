<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0//EN">
<head>
<title>
Start Bait !
</title>
<link href="../css/jquery-ui-1.8.23.custom.css" rel="stylesheet" type="text/css">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<?php
$sel=$_GET['rsel'];
if($sel!=0) {
$dat=explode( '-', $sel );
echo "<div id='bookeddetails'><center><span id='raceid' class='profitloss'><table><tr><span id='bookedmember'><p> Booked Customer Details </p></span></tr><tr><td>Race: </td><td id='race'>".$dat[0]."</td><td>Time: </td><td id='raceTime'>".$dat[1]."</td></tr></table></span></center></div><a id=crosstd1 href='index.html' class='btn'>Home !</a><br><br><a id=crosstd2 href='../select.php' class='btn'>Back !</a><br><br>";
}
else {
echo "Sorry Select the RaceID";
}
?>
<link href="../css/popup.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/popup.js"></script>
<script type="text/javascript" src="../js/bait.js"></script>
<script type="text/javascript" src="../js/onHover.js"></script>
<script type="text/javascript" src="../js/mousetrap.min.js"></script>
<script type="text/javascript" src="../js/jquery-ui-1.8.23.custom.min.js"></script>
<script type="text/javascript" src="../js/jquery.ui.autocomplete.js"></script>
<script type="text/javascript" src="../js/browserDetect.js"></script>
<script type="text/javascript">
$(document).ready(function () {
	auto("#mid");
	window.flag=0;
	window.mid=[];
	$('input.baitmob1,input.baitmob11,input.baitmob2,input.baitmob22,input.baitmob3,input.baitmob33').live('keydown',function(e) {
		if(e.keyCode==17) {
			$(this).trigger('blur');
		}
		if(e.keyCode==27) {
			$("tr.oddsamtname").fadeOut(50);
			$("tr.oddsamtname1").fadeOut(50);
		}
	});
});
function auto(id) {
var arr,key='';
$(id).die('keypress');
$(id).live('keypress',function (e) {
		arr = [];
		if(e.keyCode==13 || e.keyCode==9){
		arr = [];
		window.mid=$(this).val().trim().split(":");//splitting member name and their id
			if($($(this).closest("table").children("tbody").children("tr").children("td")[0]).children("input").val().trim().match(/^[0-9]*\.[0-9]+$/g) && (($($(this).closest("table").children("tbody").children("tr").children("td")[0]).children("input").val()<1) && ($($(this).closest("table").children("tbody").children("tr").children("td")[0]).children("input").val())>0)){
				if($($(this).closest("table").children("tbody").children("tr").children("td")[1]).children("input").val().trim().match(/^[0-9]+$/g) && $($(this).closest("table").children("tbody").children("tr").children("td")[1]).children("input").val().trim()>0) {
					if(($(this).val().trim().match(/^[0-9]*[0-9]*([0-9]\.)*[a-zA-Z]+$/g)) || ($(this).val().trim().match(/^[0-9]*[0-9]*([0-9]\.)*[a-zA-Z]+:[0-9]+$/g))){
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
								$('a.tick').trigger('click');
							}
							else {
								CrossTickAudiopopup("#suggestion-name",$(this).closest("div"),($(this).closest("table").position().top-$(this).closest("div").position().top)+10,125);
								setTimeout(function(){$("#suggestion-name").fadeOut()},1000);
							}
						}
						else {
							$('a.tick').trigger('click');
						}
					}
					else {
						CrossTickAudiopopup("#suggestion-name",$(this).closest("div"),($(this).closest("table").position().top-$(this).closest("div").position().top)+10,125);
						setTimeout(function(){$("#suggestion-name").fadeOut()},1000);
					}
				}
				else {
					CrossTickAudiopopup("#suggestion-bait",$(this).closest("div"),($(this).closest("table").position().top-$(this).closest("div").position().top)+10,60);
					setTimeout(function(){$("#suggestion-bait").fadeOut()},1000);
				}
			}
			else {
				CrossTickAudiopopup("#suggestion-odds",$(this).closest("div"),($(this).closest("table").position().top-$(this).closest("div").position().top)+10,15);
				setTimeout(function(){$("#suggestion-odds").fadeOut()},1000);
			}
		}
		key=this.value + String.fromCharCode(e.keyCode);
		var dataString = "autoname=true&req="+key;
		if(key!='') {
		$.ajax({
        url: '../bait.php',
        data: dataString,
        type: "POST",
        async: false,
        success: function (data2) {
            src = jQuery.parseJSON(data2);//this finds the member name and id for auto complete
			arr=[];
			for (i in src)
				arr[i]=src[i].name+":"+src[i].id;
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
<form action="../bait.php" method="post" id="baitForm">
<center>
<div id="page">

</div>
</center>
</form>
<div id="login-box" class="login-popup">
        <a href="#" class="close"><img src="close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
          <form method="post" class="pop" action="../bait.php" id="popForm">
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
    <form method="post" class="pop" action="../bait.php" id="tcForm">
        <table><tr>
		<td><a id="crosstd" href="#" class="cross"><img id="tick" src="cross.gif" class="btn_close1" title="Delete" alt="Close" /></a></td>
		<td><a id="audiotd" href="#" class="audio"><img src="audio.gif" class="btn_close1" title="Audio" alt="Close" /></a></td>
		</tr></table>
    </form>
</div>
<div id="add-bait" class="popup2">
    <form method="post" class="pop" action="../bait.php" id="tcForm">
        <table><tr>
		<td><a id="crosstd" href="#" class="tick"></a></td>
		</tr></table>
    </form>
</div>
<div id="suggestion-odds" class="popup3">
	<p id="suggest">Check Odds</p>
</div>
<div id="suggestion-bait" class="popup3">
	<p id="suggest">Check Amount</p>
</div>
<div id="suggestion-name" class="popup3">
	<p id="suggest">Check Name</p>
</div>
</body>
</html>