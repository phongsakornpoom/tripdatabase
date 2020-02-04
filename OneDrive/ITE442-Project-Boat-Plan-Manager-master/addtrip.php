<?php

require_once('connections.php');
require('checksession.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Pragma" content="no-cache"/>
    <meta http-equiv="Cache-Control" content="no-cache"/>
    <title>Create New Trip</title>
    <!-- Get Css -->
    <?php require 'linkcsshead.php'; ?>

</head>
<body>
    <?php require 'navbar.php'; ?>
    <div class="container">
    <h1>Create New Trip</h1>
    <br>
        <form name="addtrip" method="post" action="addtripsql.php">
        <label class="h5">Departure Date</label>
            <div class="form-group">
                <select name="day" class="dateselect p-3">
                    <?php for($d=1; $d<=31; $d++){ ?>
                        <option value="<?php echo $d;?>"><?php echo $d;?></option>
                    <?php } ?>
                </select>
                <select name="month" class="dateselect p-3">
                    <option selected value="01">January</option>
                    <option value="02">February</option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
                <select name="year" class="dateselect p-3">
                    <?php for($y=date('Y'); $y>=(date('Y')-50); $y--){ ?>
                        <option value="<?php echo $y;?>"><?php echo $y;?></option>
                    <?php } ?>
                </select>
            </div>
            <br>
            <div class="form-group">
                <label class="h5">Destination</label><br>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-info p-3">
                        <input type="radio" name="destination" value="Rayong - Koh Chang" checked> Rayong - Koh Chang<br>
                    </label>
                    <label class="btn btn-info p-3">
                        <input type="radio" name="destination" value="Other"> Other<br>
                    </label>
                </div>
            </div>
            <br>
            <div class="form-group">
                <label class="h5">Total Dives</label><br>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-warning p-3">
                        <input type="radio" name="type" value="7dives" checked> 7dives<br>
                    </label>
                    <label class="btn btn-warning p-3">
                        <input type="radio" name="type" value="11dives"> 11dives<br>
                    </label>
                </div>
            </div>
            <br>
            <input type="submit" name="submit" value="Submit" class="btn btn-success p-3 px-5" onclick="return confirm('Do you want to submit?')"/>
            <a href="main.php" type="button" class="btn btn-danger p-3 px-5">Back</a>
        </form>
    </div>

    <!-- get css script  -->
    <?php require 'linkscriptbody.php'; ?>
    
    <?php
        $conn->close();// ปิด Connection
    ?>  
</body>
</html>