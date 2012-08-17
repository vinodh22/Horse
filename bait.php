<?php
require('rb.php');
require('config.php');
R::setup(DB_TYPE.':host='.HOST.';dbname='.DB_NAME,USERNAME,PASSWORD); //MySQL
/************************************************************\
*Retrieve bait details from bait.js
\************************************************************/
$fromBait = $_POST['retrieveHorse'];
if(isset($fromBait)) {
	retrieve();
	R::close();
	exit(0);
}
/************************************************************\
*Recieve bait details from popup.js
\************************************************************/
$fromPopup = $_POST['save'];
if(isset($fromPopup)) {
    $odds = $_POST['odd'];
    $bait_amount = $_POST['amnt'];
    $member_id = $_POST['id'];
    $horse_id = $_POST['horseid'];
    $race_id = $_POST['raceid'];
    store_bait($odds,$bait_amount,$member_id,$horse_id,$race_id);
	R::close();
	exit(0);
}
/************************************************************\
*Recieve baiting person details from bait.js
\************************************************************/
$fromBaitPerson = $_POST['retrievePerson'];
if(isset($fromBaitPerson)) {
    $horse_id = $_POST['horseid'];
    $race_id = $_POST['raceid'];
    retrieve_bait_person($horse_id,$race_id);
	R::close();
	exit(0);
}
/************************************************************\
*To find profit & loss, recieve details from bait.js
\************************************************************/
$forProfitLoss = $_POST['raceinout'];
if(isset($forProfitLoss)) {
    $horse_id = $_POST['horseid'];
    $race_id = $_POST['raceid'];
    retrieve_profit_loss($horse_id,$race_id);
	R::close();
	exit(0);
}
/************************************************************\
*To find member name using autocomplete
\************************************************************/
$forAutoName = $_POST['autoname'];
if(isset($forAutoName)) {
    retrieve_person_name();
	R::close();
	exit(0);
}
/************************************************************\
*Store bait details
\************************************************************/
function store_bait($odds,$bait_amount,$member_id,$horse_id,$race_id ) {
    if($odds!='') {
        if($bait_amount!='') {
            if($member_id!='') {
                $bait = R::dispense(BAIT_TABLE);	//Creating a table if not exists
				$bait->odds = $odds;
				$bait->bait_amount = $bait_amount;
				$bait->member_id=$member_id;
				$bait->horse_id=$horse_id;
				$bait->race_id=$race_id;
				$id = R::store($bait);
				echo 'true';
            }
            else
                echo 'Customer name empty';
        }
        else
            echo 'Bait Amount empty';
    }
    else
        echo 'Odds empty';
}
/************************************************************\
*Retrieve bait details
\************************************************************/
function retrieve() {
    $column=R::getAll('select horse_number,horse_name,id from '.HORSE_TABLE.' order by horse_name');
    echo json_encode( $column);
}
/************************************************************\
*Retrieving baiting person details
\************************************************************/
function retrieve_bait_person($horse_id,$race_id) {
    $column=R::getAll('select person.name,bait.odds,bait.bait_amount from '.BAIT_TABLE.','.PERSON_TABLE.' where person.id = bait.member_id and bait.horse_id = '.$horse_id.' and bait.race_id='.$race_id.' order by bait.odds ASC');
    echo json_encode( $column);
}
/************************************************************\
*Retrieving baiting profit&loss details
\************************************************************/
function retrieve_profit_loss($horse_id,$race_id) {
    $column=R::getAll("select sum( bait_amount ) 'total', sum(( bait_amount * odds)+ bait_amount ) 'out' from ".BAIT_TABLE." where horse_id =".$horse_id.' and race_id='.$race_id.' and member_id IN (select id from '.PERSON_TABLE.')');
    echo json_encode( $column);
}
/************************************************************\
*Retrieving baiting person name by for autocomplete
\************************************************************/
function retrieve_person_name() {
    $column=R::getAll('select id,name from '.PERSON_TABLE);
    echo json_encode( $column);
}
?>