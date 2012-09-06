<?php
require('rb.php');
require('config.php');
R::setup(DB_TYPE.':host='.HOST.';dbname='.DB_NAME,USERNAME,PASSWORD); //MySQL
$name = $_POST['name'];
store_member($name);
/************************************************************\
*To update member name
\************************************************************/
$forRetrievingingPersonID = $_POST['retrievePersonID'];
if(isset($forRetrievingingPersonID)) {
    retrieve_person_id();
	R::close();
	exit(0);
}
/************************************************************\
*this function stores the member details
\************************************************************/
function store_member($name) {
    if($name!='') {
		$person = R::dispense( PERSON_TABLE );	//Creating a table if not exists
		$person->name = $name;
		$id = R::store($person);
		//echo 'Successfully Created';
		R::close();
	}
    else {
        echo 'Enter a valid name';
        R::close();
    }
}
/************************************************************\
*Retrieving baiting person details
\************************************************************/
function retrieve_person_id() {
    $column=R::getAll("select id from ".PERSON_TABLE." order by id desc limit 1 ");
    echo json_encode( $column);
}
?>