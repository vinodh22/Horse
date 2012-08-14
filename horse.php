<?php
require('rb.php');
$horse_name = $_POST['name'];
$horse_number = $_POST['num'];
$tableName='horse';
R::setup('mysql:host=localhost;dbname=horserace','root',''); //MySQL
if($horse_name!='') {
    if($horse_number!='') {
        $horse = R::dispense( $tableName );    //Creating a table if not exists
        $horse-&gt;horse_name=$horse_name;
		$horse-&gt;horse_number=$horse_number;
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