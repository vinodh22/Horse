<?php
require('rb.php');
require('config.php');
R::setup(DB_TYPE.':host='.HOST.';dbname='.DB_NAME,USERNAME,PASSWORD); //MySQL
$racing_number = $_POST['rnum'];
$racing_time = $_POST['rtime'];
$racing_date = $_POST['rdate'];
$duration = $_POST['dura'];
/************************************************************\
*this function stores the race details
\************************************************************/
if($racing_number!='') {
    if($racing_time!='') {
        if($racing_date!='') {
            if($duration!='') {
                $horse = R::dispense( RACE_TABLE);	//Creating a table if not exists
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