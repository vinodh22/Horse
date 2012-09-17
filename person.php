<?php
require('rb.php');
require('config.php');
R::setup(DB_TYPE.':host='.HOST.';dbname='.DB_NAME,USERNAME,PASSWORD); //MySQL
$name = $_POST['name'];
$do_return = $_POST['yes'];
$yes=0;
if(isset($name)) {
    store_member($name);
	if(isset($do_return) && $do_return==1) {
		if($yes==1)
			echo "true";
	}
	$forRetrievingingPersonID = $_POST['retrievePersonID'];
	if(isset($forRetrievingingPersonID)) {
		retrieve_person_id();
		R::close();
		exit(0);
	}
	R::close();
	exit(0);
}
/************************************************************\
*this function finds if the member is present
\************************************************************/
$pid = $_POST['pid'];
$pname = $_POST['pname'];
if(isset($pid) && isset($pname)){
	$column=R::getAll('SELECT id FROM '.PERSON_TABLE.' where id='.$pid.' and name="'.$pname.'"');
	if($column) {
		echo "found";
	}
	else {
		echo "not found";
	}
}
/************************************************************\
*this function stores the member details
\************************************************************/
function store_member($name) {
    if(preg_match("/^[0-9]*[0-9]*([0-9]\.)*[a-zA-Z]+$/",$name)) {
		$person = R::dispense( PERSON_TABLE );	//Creating a table if not exists
		$person->name = $name;
		$id = R::store($person);
		 $GLOBALS['yes']=1;
	}
    else {
        echo 'Enter a valid name';
    }
}
/************************************************************\
*Retrieving last baiting person id
\************************************************************/
function retrieve_person_id() {
    $column=R::getAll("select id from ".PERSON_TABLE." order by id desc limit 1 ");
    echo json_encode( $column);
}
?>