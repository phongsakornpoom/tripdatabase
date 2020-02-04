<?php

require_once('connections.php');
require('checksession.php');

$id = $_GET['id'];

// Data Query by id
$sql = "SELECT * FROM empchann_ntcdivedb.tripdetail WHERE tripid='{$id}'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$array_dpd = explode('-', $row['depart_date']);
$cyear = $array_dpd[0];
$cmonth = $array_dpd[1];
$cday = $array_dpd[2];

switch ($cmonth) {
    case '01':
        $cmonthname = 'January';
        break;
    case '02':
        $cmonthname = 'February';
        break;
    case '03':
        $cmonthname = 'March';
        break;
    case '04':
        $cmonthname = 'April';
        break;
    case '05':
        $cmonthname = 'May';
        break;
    case '06':
        $cmonthname = 'June';
        break;
    case '07':
        $cmonthname = 'July';
        break;
    case '08':
        $cmonthname = 'August';
        break;
    case '09':
        $cmonthname = 'September';
        break;
    case '10':
        $cmonthname = 'October';
        break;
    case '11':
        $cmonthname = 'November';
        break;
    case '12':
        $cmonthname = 'December';
        break;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Pragma" content="no-cache"/>
    <meta http-equiv="Cache-Control" content="no-cache"/>
    <title>Edit Trip ID <?php echo $id ?></title>
    <!-- Get Css -->
    <?php require 'linkcsshead.php'; ?>

</head>
<body>
    <?php require 'navbar.php'; ?>
    <div class="container">
    <h1>Edit Trip ID <span class="text-danger"><?php echo $id ?></span></h1>
    <hr>
        <form name="edittrip" method="post" action="edittripsql.php">
        <label class="h5">วันออกเดินทาง</label>
            <div class="form-group">
                <select name="day" class="dateselect p-3">
                    <option value="<?php echo $cday ?>"><?php echo $cday ?></option>
                    <?php for($d=1; $d<=31; $d++){ ?>
                        <option value="<?php echo $d;?>"><?php echo $d;?></option>
                    <?php } ?>
                </select>
                <select name="month" class="dateselect p-3">
                    <option selected value="<?php echo $cmonth ?>"><?php echo $cmonthname ?></option>
                    <option value="01">January</option>
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
                    <option value="<?php echo $cyear ?>"><?php echo $cyear ?></option>
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
            <input type="hidden" name="tripid" value="<?php echo $row['tripid'];?>" /><!-- Send id of edit record -->
            <input type="submit" name="submit" value="Submit" class="btn btn-success p-3 px-5" onclick="return confirm('Do you want to submit?')"/>
            <a href="main.php" type="button" class="btn btn-danger p-3 px-5">Back</a>
        </form>
    </div>

    <!-- get css script  -->
    <?php require 'linkscriptbody.php'; ?>
    
</body>
</html>