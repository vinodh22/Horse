<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0//EN">
<head>
<title>
Select Race !
</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("form").submit(function() {
		if($("#sel").val()=="0"){
			$("#msg").html("<p style='color:red'>Select Race Number !</p>").show().fadeOut(1000);
			return false;
		}
		else {
			return true;
		}
	});
});
</script>
</head>
<body>
<form action="html/bait_html.php" method="get" id="selectRaceForm">
<div id="msg" style="display:none" align="center"></div>
<a id="crosstd" href="html/index.html" class="btn">Home !</a><br><br>
<div id="container">
<table>
<tr><td style="width:auto;">Race number: </td><td>
<select id="sel" name="rsel">
<option value="0">Racing:No - Racing-Time</option>
<?php
require('rb.php');
require('config.php');
R::setup(DB_TYPE.':host='.HOST.';dbname='.DB_NAME,USERNAME,PASSWORD); //MySQL
/************************************************************\
*this function retrieves the race number
\************************************************************/
		$column=R::getAll('SELECT racing_number,racing_time FROM '.RACE_TABLE);
		for($j=0;$j<count($column);$j++) {?>
        <option value=<?php echo $column[$j]['racing_number']."-".$column[$j]['racing_time'] ?>><?php echo $column[$j]['racing_number']."-".$column[$j]['racing_time'] ; ?></option>
    <?php }
?>
</select></td></tr>
<tr><td><input type="submit" id="btn" value="Done !"></td></tr>
</table>
</div>
</form>
</body>
</html>
