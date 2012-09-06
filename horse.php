<?php
require('rb.php');
require('config.php');
R::setup(DB_TYPE.':host='.HOST.';dbname='.DB_NAME,USERNAME,PASSWORD); //MySQL
$horse_name = $_POST['name'];
$horse_number = $_POST['num'];
$race_number = $_POST['race'];
/************************************************************\
*this function stores the horse details
\************************************************************/
if($horse_name!='') {
    if($horse_number!='') {
        $horse = R::dispense( HORSE_TABLE );    //Creating a table if not exists
        $horse->horse_name=$horse_name;
		$horse->horse_number=$horse_number;
		$horse->race_number=$race_number;
        $id = R::store($horse);
        echo 'Successfully Created';
        R::close();
    }
    else
    echo 'Horse number empty';
}
else
echo 'Horse name empty';
?>