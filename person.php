<?php
require('rb.php');
$tableName='person';
R::setup('mysql:host=localhost;
dbname=horserace','root','');
//MySQL
$name = $_POST['name'];
$age = $_POST['age'];
$sex = $_POST['sex'];
$contact_number = $_POST['num'];
$addr1 = $_POST['addr1'];
$addr2 = $_POST['addr2'];
$city = $_POST['city'];
$pin = $_POST['pin'];
$state = $_POST['state'];
$nationality = $_POST['nation'];
store_member($tableName,$name,$age,$sex,$contact_number,$addr1,$addr2,$city,$pin,$state,$nationality);
/************************************************************\
*
\************************************************************/
function store_member($tableName,$name,$age,$sex,$contact_number,$addr1,$addr2,$city,$pin,$state,$nationality) {
    if($name!='') {
        if($age!='') {
            if(isset($sex)) {
                if($contact_number!='') {
                    if($addr1!='' && $addr2!='') {
                        if($city!='') {
                            if($pin!='') {
                                if($state!='') {
                                    if($nationality!='') {
                                        $person = R::dispense( $tableName );	//Creating a table if not exists
										$person->name = $name;
										$person->age = $age;
										$person->sex=$sex;
										$person->contact_number=$contact_number;
										$person->addr1=$addr1;
										$person->addr2=$addr2;
										$person->city=$city;
										$person->pin=$pin;
										$person->state=$state;
										$person->nationality=$nationality;
										$id = R::store($person);
										echo 'Successfully Created';
										R::close();
                                    }
                                    else {
                                        echo 'Enter country';
                                        R::close();
                                        //echo json_encode('Customer name empty');
                                    }
                                }
                                else {
                                    echo 'Enter state';
                                    R::close();
                                }
                            }
                            else {
                                echo 'Enter a valid pin';
                                R::close();
                            }
                        }
                        else {
                            echo 'Enter city';
                            R::close();
                        }
                    }
                    else {
                        echo 'Enter a valid Address';
                        R::close();
                    }
                }
                else {
                    echo 'Enter a valid Contact number';
                    R::close();
                }
            }
            else {
                echo 'Mark the Sex field';
                R::close();
            }
        }
        else {
            echo 'Enter your Date Of Birth';
            R::close();
        }
    }
    else {
        echo 'Enter a valid name';
        R::close();
    }
}
?>