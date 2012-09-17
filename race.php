<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0//EN">
<head>
<title>
Horse Entry
</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery.js"></script>
</head>
<body>
<form action="../horse.php" method="post" id="entryForm">
<div id="container">
<?php
require('rb.php');
require('config.php');
R::setup(DB_TYPE.':host='.HOST.';dbname='.DB_NAME,USERNAME,PASSWORD); //MySQL
$racing_number = $_POST['rnum'];
$racing_time = $_POST['rtime'];
$racing_date = $_POST['rdate'];
$No_Of_Horse = $_POST['nohor'];
$div='';
//echo $racing_number.$racing_time.$racing_date.$No_Of_Horse;
/************************************************************\
*this function stores the race details
\************************************************************/
if(preg_match("/^[0-9]+$/",$racing_number)) {
    if($racing_time!='00:00' || (!$racing_time)) {
        if(preg_match("/^[0-9.]+$/",$racing_date) || (!$racing_date)) {
			if(preg_match("/^[0-9]+$/",$No_Of_Horse)) {
				$horse = R::dispense( RACE_TABLE);	//Creating a table if not exists
				$horse->racing_number = $racing_number;
				$horse->racing_time = $racing_time;
				$horse->racing_date=$racing_date;
				$id = R::store($horse);
				R::close();
				if(isset($No_Of_Horse)) {
					for($j=0;$j<$No_Of_Horse;$j++) {
						$div.="<div id='vin-".$racing_number."-". ($j + 1) ."' class='thumbnail1'><table class='addhor'><tr><td>Number:</td><td><input class='numhor' type='text' name='Horsenum' readonly='readonly' value='".($j + 1)."'></td></tr><tr><td>Name:</td><td><input id=".($j+1)." class='namehor' type='text' name='Horsename' value=''></td></tr></table></div>";
					}
					$div.="<table class='thumbnail1'><tr><td><a id='ok' href='#' class='btn' onclick='callme()'>Create Race !</a></td></tr><tr><td><a id='goback' href='html/race.html' class='btn'>Go Back !</a></td></tr><tr><td><a id='gohome' href='html/index.html' class='btn'>Main Menu !</a></td></tr><tr><td><a id='addmore' href='html/horse.php' class='btn'>Add More !</a></td></tr></table><table class='thumbnail1' id='msg' style='display:none' align='center'></table>";
					echo $div;
					}
			}
			else
			echo 'Horse count empty';
        }
        else
        echo 'Racing date empty';
    }
    else
    echo 'Racing Time empty';
}
else
echo 'Race number empty';
?>
<script type="text/javascript">
$(document).ready(function(){
	$(".numhor").live('keyup',function (e) {
		if(this.value.match(/^[a-zA-Z]+$/g) || (!this.value)) {
			$("#ok").removeAttr("disabled");
		}
		else
			$("#ok").attr("disabled", "disabled");
	});
});
function callme(){
 var hsplit = $("#container div").attr("id").split("-");
 var jsonObj = [],not_null_count=0,total=0,hno='';
 $(".namehor,.numhor").each(function(data){
 total++;
	if($(this).val()) {
		not_null_count++;
	}
 });
	$("#container div").each(function(data){
	jsonObj.push({name: $(this).find("input.namehor").val(), num: $(this).find("input.numhor").val(),rsel:hsplit[1]});
	});
	$(".namehor").each(function(data){
		if((!this.value.match(/^[a-zA-Z]+$/g))) {
			hno+="<br> Horse Number:"+$(this).attr("id");
			not_null_count--;
			}
	});
	if(not_null_count<total){
		$("#msg").html("<p style='color:red'>Check:"+hno+"</p>").fadeIn().delay(300).fadeOut();
	}
	if(not_null_count==total){
	var dataString = 'json='+JSON.stringify(jsonObj)+"&setHorse=1";
	console.log(dataString);
		$.ajax({
			url: 'horse.php',
			data: dataString,
			type: "POST",
			async: false,
			success: function (data) {
				$("#msg").html("<p style='color:red'> Successfully Created !</p>").fadeIn().delay(300).fadeOut();
				$("#ok").attr("disabled", "disabled");
				$(".numhor").val('');
				$(".namehor").val('');
			}
		});
	}
}
</script>
</div>
</form>
</body>
</html>