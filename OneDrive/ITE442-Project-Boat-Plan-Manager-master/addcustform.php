<?php

require_once('connections.php');
require('checksession.php');

$firstname = trim($_POST['firstname']);
$middlename = trim($_POST['middlename']);
$lastname = trim($_POST['lastname']);
$gender = trim($_POST['gender']);
$email = trim($_POST['email']);
$lineid = trim($_POST['lineid']);
$facebook = trim($_POST['facebook']);
$phone = trim($_POST['phone']);
$certno = trim($_POST['certno']);
$certlevel = trim($_POST['certlevel']);
$certagent = trim($_POST['certagent']);
$nodive = trim($_POST['totaldives']);

$day = $_POST['day'];
$month = $_POST['month'];
$year = $_POST['year'];
$lastdive = $year.'-'.$month.'-'.$day;

$notes = trim($_POST['notes']);

$middlename = !empty($middlename) ? "'$middlename'" : "NULL";
$lastname = !empty($lastname) ? "'$lastname'" : "NULL";
$lineid = !empty($lineid) ? "'$lineid'" : "NULL";
$email = !empty($email) ? "'$email'" : "NULL";
$facebook = !empty($facebook) ? "'$facebook'" : "NULL";
$phone = !empty($phone) ? "'$phone'" : "NULL";
$certno = !empty($certno) ? "'$certno'" : "NULL";
$nodive = !empty($nodive) ? "'$nodive'" : "NULL";
$notes = !empty($notes) ? "'$notes'" : "NULL";

$sql = "INSERT INTO empchann_ntcdivedb.passengerinfo (firstname, middlename, lastname, gender, email, lineid, facebook, phone, certno, certlevel, certagent, nodive, lastdive, notes) VALUES ('{$firstname}', $middlename, $lastname, '{$gender}', $email, $lineid, $facebook, $phone, $certno, '{$certlevel}', '{$certagent}', $nodive, '{$lastdive}', $notes)";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Pragma" content="no-cache"/>
    <meta http-equiv="Cache-Control" content="no-cache"/>
    <title>Add Customer</title>
    <!-- Get Css -->
    <?php require 'linkcsshead.php'; ?>
    
</head>
<body>
    <?php require 'navbar.php'; ?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <table width="100%" cellpadding="5" cellspacing="5">
                    <tr>
                        <td>
                            <h2>Add Customer</h2>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center;">
                            <?php
                                // If insert data successfully, show information and redirect to main.php
                                if($conn->query($sql) == TRUE){
                                    echo "<div id='message'>Create Customer Successfully <hr/>Please wait to redirect...</div>";
                                    echo "<meta http-equiv='refresh' content='0;url=main.php'>"; // Redirect to main.php
                            } else {
                                    echo "<div id='message'>Error: " . $sql . "<br>" . $conn->error ."<hr/>Please wait to redirect...</div>";
                                    echo "<meta http-equiv='refresh' content='10;url=main.php'>"; // Redirect to main.php
                            }
                            ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    <?php $conn->close(); ?>

    <!-- get css script  -->
    <?php require 'linkscriptbody.php'; ?>
</body>
</html>