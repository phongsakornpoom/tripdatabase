<?php

require_once('connections.php');
require('checksession.php');

$id = trim($_GET['id']); // Sent id by method GET , receive with $_GET

$tripid = trim($_GET['trip']);

$sql = "DELETE FROM empchann_ntcdivedb.equiprental WHERE rent_id='{$id}'";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Pragma" content="no-cache"/>
    <meta http-equiv="Cache-Control" content="no-cache"/>
    <title>Delete Rental</title>
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
                            <h2>Delete Rent</h2>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center;">
                            <?php
                                if($conn->query($sql) == TRUE){
                                    echo "<div id='message'>Record deleted successfully <hr/>Please wait to redirect...</div>";
                                    echo "<meta http-equiv='refresh' content='5;url=viewtrip.php?id=$tripid'>";
                            } else {
                                    echo "<div id='message'>Error: " . $sql . "<br>" . $conn->error ."<hr/>Please wait to redirect...</div>";
                                    echo "<meta http-equiv='refresh' content='10;url=viewtrip.php?id=$tripid'>"; 
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