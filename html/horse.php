<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0//EN">
<head>
<title>
Horse Entry
</title>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript">
function checkMe() {
	if(!$("#hname").val().match(/^[a-zA-Z]+$/g)) {
		$("#msg").html("<p style='color:red'>Check Horse name</p>").show().fadeOut(1000);
	}
	else if(!$("#hnum").val().match(/^[0-9]+$/g)) {
		$("#msg").html("<p style='color:red'>Check Horse number</p>").show().fadeOut(1000);
	}
	else if(!$("#sel").val().match(/^[1-9]+$/g)) {
		$("#msg").html("<p style='color:red'>Select Race number</p>").show().fadeOut(1000);
	}
	else {
	var datastring="name="+$("#hname").val()+"&num="+$("#hnum").val()+"&rsel="+$("#sel").val(),race="hno="+$("#hnum").val()+"&raceno="+$("#sel").val();
		$.post('../horse.php',
		race
		, function (data) {
        if(data=="found"){
			$("#msg").html("<p style='color:red'>Horse Number Exists !</p>").show().fadeOut(1000);
		}
		else if(data=="not found"){
			$.post('../horse.php',
			datastring
			, function (data1) {
			if(data1=="sorry") {
				$("#msg").html("<p style='color:red'>Error Occured</p>").show().fadeOut(1000);
			}
			else{
				$("#msg").html("<p style='color:red'>Successfully Created</p>").show().fadeOut(1000);
				$("#hname,#hnum").val('');
				$("#sel").val("-1")
			}
			});
		}
		});
	}
}
</script>
</head>
<body>
<form action="#Horse_Entery" method="post" id="HorsentryForm">
<div id="msg" style="display:none" align="center"></div>
<a id="crosstd" href="index.html" class="btn">Home !</a><br><br>
<div id="container">
<input type="text"  name="setHorse" value="1" style="display:none;">
<table>
<tr>
<td>Horse:</td>
</tr>
<tr><td>Name:</td><td><input id="hname" type="text" name="name"><td></tr>
<tr><td>Number:</td><td><input id="hnum" type="text" name="num"><td></tr>
<tr><td style="width:auto;">Race Number:</td><td><select id="sel" name="rsel">
<option value="0">Racing:No - Racing-Time</option>
<?php
require('../rb.php');
require('../config.php');
R::setup(DB_TYPE.':host='.HOST.';dbname='.DB_NAME,USERNAME,PASSWORD); //MySQL
/************************************************************\
*this function retrieves the race number
\************************************************************/
		$column=R::getAll('SELECT racing_number FROM '.RACE_TABLE);
		for($j=0;$j<count($column);$j++) {?>
        <option value=<?php echo $column[$j]['racing_number']?>><?php echo $column[$j]['racing_number']; ?></option>
    <?php }
?>
</select></td></tr
<tr><td><input type="button" id="btn" value="Done !" onclick="checkMe()"></td></tr>
</table>
</div>
</form>
</body>
</html>
