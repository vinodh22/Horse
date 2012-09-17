<?php
require('rb.php');
require('config.php');
R::setup(DB_TYPE.':host='.HOST.';dbname='.DB_NAME,USERNAME,PASSWORD); //MySQL

/************************************************************\
*Retrieve bait details from bait.js
\************************************************************/
$fromBait = $_POST['retrieveHorse'];
if(isset($fromBait)) {
$race_id = $_POST['raceid'];
	retrieve($race_id);
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
	$win_or_place = $_POST['winplace'];
    store_bait($odds,$bait_amount,$member_id,$horse_id,$race_id,$win_or_place);
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
	$w_or_p = $_POST['w_or_p'];
    retrieve_bait_person($horse_id,$race_id,$w_or_p);
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
	$w_or_p = $_POST['w_or_p'];
    retrieve_profit_loss($horse_id,$race_id,$w_or_p);
	R::close();
	exit(0);
}
/************************************************************\
*To find member name using autocomplete
\************************************************************/
$forAutoName = $_POST['autoname'];
if(isset($forAutoName)) {
	$pat=$_POST['req'];
    retrieve_person_name($pat);
	R::close();
	exit(0);
}
/************************************************************\
*To insert previous odd amount
\************************************************************/
$forPreviousOdd = $_POST['insertPrevious'];
if(isset($forPreviousOdd)) {
	$horse_id = $_POST['horseid'];
    $race_id = $_POST['raceid'];
	$w_or_p = $_POST['flag'];
    retrieve_previous_odd($horse_id,$race_id,$w_or_p);
	R::close();
	exit(0);
}
/************************************************************\
*To update bait odds
\************************************************************/
$forUpdatingBaitOdds = $_POST['updateOdds'];
if(isset($forUpdatingBaitOdds)) {
	$bait_id = $_POST['bid'];
    $bait_odds = $_POST['odds'];
    update_bait_odds($bait_id,$bait_odds);
	R::close();
	exit(0);
}
/************************************************************\
*To update bait amount
\************************************************************/
$forUpdatingBaitAmount = $_POST['updateAmount'];
if(isset($forUpdatingBaitAmount)) {
	$bait_id = $_POST['bid'];
	$bait_amount = $_POST['amount'];
    update_bait_amount($bait_id,$bait_amount);
	R::close();
	exit(0);
}
/************************************************************\
*To update member name
\************************************************************/
$forUpdatingPersonID = $_POST['updateMemberID'];
if(isset($forUpdatingPersonID)) {
    $member_id_old = $_POST['idold'];
	$member_id_new = $_POST['idnew'];
	$horse_id = $_POST['horseid'];
    $race_id = $_POST['raceid'];
	$odds = $_POST['odd'];
	$amt = $_POST['amt'];
    update_person_ID($member_id_old,$member_id_new,$horse_id,$race_id,$odds,$amt);
	R::close();
	exit(0);
}
/************************************************************\
*To delete bait details
\************************************************************/
$forDeletingBait = $_POST['deleteBait'];
if(isset($forDeletingBait)) {
	$bait_id = $_POST['baitid'];
    delete_bait($bait_id);
	R::close();
	exit(0);
}

/************************************************************\
*Store bait details
\************************************************************/
function store_bait($odds,$bait_amount,$member_id,$horse_id,$race_id,$win_or_place ) {
    if(preg_match("/^[0-9]*\.[0-9]+$/",$odds)) {
        if(preg_match("/^[0-9]+$/",$bait_amount)) {
            if(preg_match("/^[0-9]+$/",$member_id)) {
				if(preg_match("/^[0-9]+$/",$horse_id) && preg_match("/^[0-9]+$/",$race_id)) {
					if(preg_match("/^[0-9]+$/",$win_or_place)) {
						$bait = R::dispense(BAIT_TABLE);	//Creating a table if not exists
						$bait->odds = $odds;
						$bait->bait_amount = $bait_amount;
						$bait->member_id=$member_id;
						$bait->horse_id=$horse_id;
						$bait->race_id=$race_id;
						$bait->win_or_place=$win_or_place;
						$id = R::store($bait);
						$col1=array("check" => "true");
						$col2=R::getAll("select max(person.id) 'pid',max(bait.id) 'bid' from ".PERSON_TABLE.",".BAIT_TABLE);
						$column=array_merge($col1, $col2);
					echo json_encode($column);
					}
					else
						echo json_encode(array(0 => 'Win Or Place Bait'));
				}
				else
					echo json_encode(array(0 => 'Horse ID or Race ID is empty'));
            }
            else
                echo json_encode(array(0 => 'Customer name empty'));
        }
        else
            echo json_encode(array(0 => 'Bait Amount empty'));
    }
    else
        echo json_encode(array(0 => 'Odds empty'));
}
/************************************************************\
*Retrieve bait details
\************************************************************/
function retrieve($race_id) {
    $column=R::getAll('select horse_number,horse_name,id from '.HORSE_TABLE.' where race_number='.$race_id.' order by horse_number');
    echo json_encode( $column);
}
/************************************************************\
*Retrieving baiting person details
\************************************************************/
function retrieve_bait_person($horse_id,$race_id,$w_or_p) {
    $column=R::getAll("select person.name,bait.odds,bait.bait_amount,bait.id 'bid',person.id 'pid' from ".BAIT_TABLE.",".PERSON_TABLE." where person.id = bait.member_id and bait.horse_id = ".$horse_id." and win_or_place=".$w_or_p." and bait.race_id=".$race_id);
    echo json_encode( $column);
}
/************************************************************\
*Retrieving baiting profit&loss details
\************************************************************/
function retrieve_profit_loss($horse_id,$race_id,$w_or_p) {
    $column=R::getAll("select sum( bait_amount ) 'total', sum(( bait_amount * odds)+ bait_amount ) 'out',(SELECT sum(bait_amount) FROM ".BAIT_TABLE." WHERE race_id=".$race_id." and win_or_place=1) 'winc',(SELECT sum(bait_amount) FROM ".BAIT_TABLE." WHERE race_id=".$race_id." and win_or_place=0) 'placec' from ".BAIT_TABLE." where horse_id =".$horse_id." and race_id=".$race_id." and win_or_place=".$w_or_p." and member_id IN (select id from ".PERSON_TABLE.")");
    echo json_encode( $column);
}
/************************************************************\
*Retrieving baiting person name by for autocomplete
\************************************************************/
function retrieve_person_name( $pat) {
    $column=R::getAll("select id,name from ".PERSON_TABLE." where name like '".$pat."%'");
    echo json_encode( $column);
}
/************************************************************\
*Retrieving previous odd amount
\************************************************************/
function retrieve_previous_odd($horse_id,$race_id,$w_or_p) {
	$column=R::getAll('SELECT odds FROM '.BAIT_TABLE.' WHERE horse_id='.$horse_id.' and race_id='.$race_id.' and win_or_place='.$w_or_p.' order by id desc limit 1 ');
    echo json_encode( $column);
}
/************************************************************\
*Delete bait details
\************************************************************/
function delete_bait($bait_id) {
	$column=R::getAll("DELETE from bait where id=".$bait_id);
	if($column)
	echo json_encode(array(0 => 'true'));
}
/************************************************************\
*To update bait odds
\************************************************************/
function update_bait_odds($bait_id,$bait_odds) {
	if(preg_match("/^[0-9]*\.[0-9]+$/",$bait_odds)) {
		if(preg_match("/^[0-9]+$/",$bait_id)) {
			$column=R::exec("UPDATE ".BAIT_TABLE." SET odds=".$bait_odds." where id=".$bait_id);
			echo json_encode(array(0 => "Updated",1=> $bait_odds));
			die();
		}
		else
            echo json_encode(array(0 => 'Bet ID empty'));
	}
    else
        echo json_encode(array(0 => 'Odds empty'));
}
/************************************************************\
*To update bait amount
\************************************************************/
function update_bait_amount($bait_id,$bait_amount) {
	if(preg_match("/^[0-9]+$/",$bait_amount)) {
		if(preg_match("/^[0-9]+$/",$bait_id)) {
			$column=R::exec("UPDATE ".BAIT_TABLE." SET bait_amount=".$bait_amount." where id=".$bait_id);
			echo json_encode(array(0 => "Updated",1=> $bait_amount));
			die();
		}
		else
            echo json_encode(array(0 => 'Bet ID empty'));
	}
    else
        echo json_encode(array(0 => 'Bet Amount empty'));
}
/************************************************************\
*To update member name
\************************************************************/
function update_person_ID($member_id_old,$member_id_new,$horse_id,$race_id,$odds,$amt) {
	if(preg_match("/^[0-9]+$/",$member_id_old)) {
		if(preg_match("/^[0-9]+$/",$member_id_new)) {
			if(preg_match("/^[0-9]+$/",$horse_id) && preg_match("/^[0-9]+$/",$race_id)) {
				if(preg_match("/^[0-9]*\.[0-9]+$/",$odds)) {
					if(preg_match("/^[0-9]+$/",$amt)) {
						$column=R::exec("UPDATE ".BAIT_TABLE." SET member_id='".$member_id_new."' where odds=".$odds." and bait_amount=".$amt." and member_id=".$member_id_old." and horse_id=".$horse_id." and race_id=".$race_id);
						echo json_encode(array(0 => "Updated",1 => $member_id_new));
						die();
					}
					else
						echo json_encode(array(0 => 'Amount Empty'));
				}
				else
					echo json_encode(array(0 => 'Odds Empty'));
			}
			else
				echo json_encode(array(0 => 'Horse ID Or Race ID is Empty'));
		}
		else
			echo json_encode(array(0 => 'New Memeber ID Empty'));
	}
	else
        echo json_encode(array(0 => 'Old Memeber ID Empty'));
}
?>