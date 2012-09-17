<?php
require('rb.php');
require('config.php');
R::setup(DB_TYPE.':host='.HOST.';dbname='.DB_NAME,USERNAME,PASSWORD); //MySQL
$setHorse = $_POST['setHorse'];
$num =  $_POST['raceno'];
$hno =  $_POST['hno'];
if(isset($num) && isset($hno)){
	$column=R::getAll('SELECT id FROM '.HORSE_TABLE.' where horse_number='.$hno.' and race_number='.$num);
	if(!$column) {
		echo "not found";
	}
	else {
		echo "found";
	}
}
$rcno =  $_POST['rcno'];
if(isset($rcno)){
	$column=R::getAll('SELECT id FROM '.RACE_TABLE.' where racing_number='.$rcno);
	if(!$column) {
		echo "not found";
	}
	else {
		echo "found";
	}
}
$cnt=0;
$total=0;
$arr=array();
	if(isset($setHorse)){
		if(isset($_POST['json'])){
			$data = json_decode($_POST['json']);
			foreach ($data as $d) {
			$total++;
				if((preg_match("/^[a-zA-Z]+$/",$d->name)) && (preg_match("/^[1-9]+$/",$d->num)) && (preg_match("/^[1-9]+$/",$d->rsel))) {
					$cnt++;
					}
				else {
					echo "sorry";
					die();
				}
			}
			$data = json_decode($_POST['json']);
			if($total==$cnt){
				foreach ($data as $d) {
					create_horse($d->name,$d->num,$d->rsel);
				}
			}
		}
	}
	else if((preg_match("/^[a-zA-Z]+$/",$_POST['name'])) && (preg_match("/^[1-9]+$/",$_POST['num'])) && (preg_match("/^[1-9]+$/",$_POST['rsel']))){
		create_horse($_POST['name'],$_POST['num'],$_POST['rsel']);
	}
/************************************************************\
*this function stores the horse details
\************************************************************/
function create_horse($horse_name,$horse_number,$race_number) {
	if(preg_match("/^[a-zA-Z]+$/",$horse_name)) {
		if(preg_match("/^[1-9]+$/",$horse_number)) {
			if(preg_match("/^[1-9]+$/",$race_number)) {
				$horse = R::dispense( HORSE_TABLE );    //Creating a table if not exists
				$horse->horse_name=$horse_name;
				$horse->horse_number=$horse_number;
				$horse->race_number=$race_number;
				$id = R::store($horse);
				R::close();
				}
			else
				echo 'Race number empty';
		}
		else
			echo 'Horse number empty';
	}
	else
		echo 'Horse name empty';
}
?>