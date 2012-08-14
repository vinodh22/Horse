<?php
require('rb.php');
$tableName1='bait';
$tableName2='horse';
$tableName3='person';
$tableName4='race';
R::setup('mysql:host=localhost;dbname=horserace','root',''); //MySQL
/************************************************************\
*Retrieve bait details from bait.js
\************************************************************/
$fromBait = $_POST['retr'];
if(isset($fromBait))
retrieve($tableName2);
/************************************************************\
*Recieve bait details from popup.js
\************************************************************/
$fromPopup = $_POST['save'];
if(isset($fromPopup)) {
    $odds = $_POST['odd'];
    $bait_amount = $_POST['amnt'];
    $member_id = $_POST['id'];
    $horse_id = $_POST['hrnm'];
    $race_id = $_POST['rid'];
    store_bait($tableName1,$odds,$bait_amount,$member_id,$horse_id,$race_id);
}
/************************************************************\
*Recieve baiting person details from bait.js
\************************************************************/
$fromBaitPerson = $_POST['retrb'];
if(isset($fromBaitPerson)) {
    $horse_id = $_POST['hid'];
    $race_id = $_POST['rid'];
    retrieve_bait_person($horse_id,$race_id);
}
/************************************************************\
*To find profit & loss, recieve details from bait.js
\************************************************************/
$forProfitLoss = $_POST['rinout'];
if(isset($forProfitLoss)) {
    $horse_id = $_POST['hid'];
    $race_id = $_POST['rid'];
    retrieve_profit_loss($horse_id,$race_id);
}

/************************************************************\
*Store bait details
\************************************************************/
function store_bait($tableName,$odds,$bait_amount,$member_id,$horse_id,$race_id ) {
    if($odds!='') {
        if($bait_amount!='') {
            if($member_id!='') {
                $bait = R::dispense( $tableName );	//Creating a table if not exists
				$bait->odds = $odds;
				$bait->bait_amount = $bait_amount;
				$bait->member_id=$member_id;
				$bait->horse_id=$horse_id;
				$bait->race_id=$race_id;
				$id = R::store($bait);
				//echo json_encode('Successfully Created');
				echo 'Successfully Created';
				R::close();
            }
            else {
                echo 'Customer name empty';
                R::close();
            }
            //echo json_encode('Customer name empty');
        }
        else {
            echo 'Bait Amount empty';
            R::close();
            //echo json_encode('Bait Amount empty');
        }
    }
    else {
        echo 'Odds empty';
        R::close();
        //echo json_encode('Odds empty');
    }
}
/************************************************************\
*Retrieve bait details
\************************************************************/
function retrieve($tableName) {
    //$count=R::count($tableName);
    //$find=array();
    $column=R::getAll('select horse_number,horse_name,id from horse order by horse_name');
    echo json_encode( $column);
    R::close();
    exit(0);
}
/************************************************************\
*Retrieving baiting person details
\************************************************************/
function retrieve_bait_person($horse_id,$race_id) {
    $column=R::getAll('select person.name,bait.odds,bait.bait_amount from person,bait where person.id = bait.member_id and bait.horse_id = '.$horse_id.' and bait.race_id='.$race_id.' order by person.name ASC');
    echo json_encode( $column);
    R::close();
    exit(0);
}
/************************************************************\
*Retrieving baiting profit&loss details
\************************************************************/
function retrieve_profit_loss($horse_id,$race_id) {
    $column=R::getAll("select sum( bait_amount ) 'total', sum(( bait_amount * odds)+ bait_amount ) 'out' from bait where horse_id =".$horse_id.' and race_id='.$race_id.' and member_id IN (select id from person)');
    echo json_encode( $column);
    R::close();
    exit(0);
}
?>