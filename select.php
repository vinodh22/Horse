<?php
require('rb.php');
require('config.php');
R::setup(DB_TYPE.':host='.HOST.';dbname='.DB_NAME,USERNAME,PASSWORD); //MySQL
$race_number = $_POST['num'];
retrieve_Race_Number();

function retrieve_Race_Number() {
/************************************************************\
*this function retrieves the race number
\************************************************************/
		$column=R::getAll('SELECT id,racing_number,racing_time FROM '.RACE_TABLE);
		echo json_encode( $column);
        R::close();
}
?>