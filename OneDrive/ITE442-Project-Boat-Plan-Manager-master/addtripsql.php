<?php

require_once('connections.php');
require('checksession.php');

$destination = trim($_POST['destination']);
$type = trim($_POST['type']);

$day = $_POST['day'];
$month = $_POST['month'];
$year = $_POST['year'];
$depart_date = $year.'-'.$month.'-'.$day;
$showdate = $day.'/'.$month.'/'.$year;

$sql = "INSERT INTO empchann_ntcdivedb.tripdetail (depart_date, destination, type) VALUES ('{$depart_date}', '{$destination}', '{$type}')";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Pragma" content="no-cache"/>
    <meta http-equiv="Cache-Control" content="no-cache"/>
    <title>Add Trip</title>
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
                            <h2>Add Trip</h2>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center;">
                            <?php
                                // If insert data successfully, show information and redirect to main.php
                                if($conn->query($sql) == TRUE){
                                    echo "<div id='message'><h3>New Trip created successfully<br><br> 
                                    Trip Detail:<br>
                                    Departure Date: <span class='text-danger'>$showdate</span><br>
                                    Destination: <span class='text-danger'>$destination</span><br>
                                    Total Dives: <span class='text-danger'>$type</span></h3><br>
                                    <hr/>Please wait to redirect...</div>";
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