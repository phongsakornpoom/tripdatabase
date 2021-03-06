<?php

require_once('connections.php');
require('checksession.php');

$id = $_POST['id'];
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
$notes = trim($_POST['notes']);

$day = $_POST['day'];
$month = $_POST['month'];
$year = $_POST['year'];

$lastdive = $year.'-'.$month.'-'.$day;

$sql = "UPDATE empchann_ntcdivedb.passengerinfo SET firstname='{$firstname}',middlename='{$middlename}',lastname='{$lastname}',gender='{$gender}',email='{$email}',lineid='{$lineid}',facebook='{$facebook}',phone='{$phone}',certno='{$certno}',certlevel='{$certlevel}',certagent='{$certagent}',nodive='{$nodive}',lastdive='{$lastdive}',notes='{$notes}' WHERE passengerid='$id'";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Pragma" content="no-cache"/>
    <meta http-equiv="Cache-Control" content="no-cache"/>
    <title>Edit Customer</title>
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
                        <h2>Edit Customer</h2>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center;">
                        <?php
                        if($conn->query($sql) == TRUE){
                            echo "<div id='message'>Edit Customer successfully <hr/>Please wait to redirect...</div>";
                            echo "<meta http-equiv='refresh' content='0;url=main.php'>";
                        } else {
                            echo "<div id='message'>Error: " . $sql . "<br>" . $conn->error ."<hr/>Please wait to redirect...</div>";
                            echo "<meta http-equiv='refresh' content='5;url=main.php'>";
                        }
                        ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <?php $conn->close(); ?>
</div>

    <!-- get css script  -->
    <?php require 'linkscriptbody.php'; ?>
</body>
</html>
