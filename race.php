<?php
require('rb.php');
$racing_number = $_POST['rnum'];
$racing_time = $_POST['rtime'];
$racing_date = $_POST['rdate'];
$duration = $_POST['dura'];
$tableName='race';
R::setup('mysql:host=localhost;dbname=horserace','root',''); //MySQL
if($racing_number!='') {
    if($racing_time!='') {
        if($racing_date!='') {
            if($duration!='') {
                $horse = R::dispense( $tableName );	//Creating a table if not exists
				$horse->racing_number = $racing_number;
				$horse->racing_time = $racing_time;
				$horse->racing_date=$racing_date;
				$horse->duration=$duration;
				$id = R::store($horse);
				echo 'Successfully Created';
				R::close();
            }
            else
            echo 'Duration empty';
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