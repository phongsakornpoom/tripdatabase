<?php

require_once('connections.php');
require('checksession.php');
include 'src/php/helper.php';

$sql = "SELECT empchann_ntcdivedb.passengerinfo.*, COUNT(empchann_ntcdivedb.trip_passenger.passengerid) AS triptimes,
-- SUM(empchann_ntcdivedb.roomtype.roomprice7dives) AS totalprices, 
empchann_ntcdivedb.tripdetail.type, 
CASE 
WHEN empchann_ntcdivedb.tripdetail.type = '7dives' THEN SUM(empchann_ntcdivedb.roomtype.roomprice7dives) 
WHEN empchann_ntcdivedb.tripdetail.type = '11dives' THEN SUM(empchann_ntcdivedb.roomtype.roomprice11dives) 
END AS totalprices 
FROM empchann_ntcdivedb.passengerinfo INNER JOIN empchann_ntcdivedb.trip_passenger 
ON empchann_ntcdivedb.passengerinfo.passengerid = empchann_ntcdivedb.trip_passenger.passengerid 
INNER JOIN empchann_ntcdivedb.roomtype 
ON empchann_ntcdivedb.trip_passenger.roomtype = empchann_ntcdivedb.roomtype.roomid 
INNER JOIN empchann_ntcdivedb.tripdetail 
ON empchann_ntcdivedb.trip_passenger.tripid = empchann_ntcdivedb.tripdetail.tripid 
GROUP BY empchann_ntcdivedb.passengerinfo.passengerid 
-- ,empchann_ntcdivedb.tripdetail.type 
ORDER BY triptimes DESC, totalprices DESC";
$result = $conn->query($sql);

$tripsql = "SELECT empchann_ntcdivedb.tripdetail.*, count(empchann_ntcdivedb.trip_passenger.tripid) AS noPassenger 
FROM empchann_ntcdivedb.tripdetail LEFT JOIN empchann_ntcdivedb.trip_passenger 
ON empchann_ntcdivedb.tripdetail.tripid = empchann_ntcdivedb.trip_passenger.tripid 
GROUP BY empchann_ntcdivedb.tripdetail.tripid 
ORDER BY noPassenger DESC";
$tripresult = $conn->query($tripsql);

$rentsql = "SELECT empchann_ntcdivedb.passengerinfo.*, COUNT(empchann_ntcdivedb.equiprental.passengerid) AS renttimes 
FROM empchann_ntcdivedb.passengerinfo LEFT JOIN empchann_ntcdivedb.equiprental 
ON empchann_ntcdivedb.passengerinfo.passengerid = empchann_ntcdivedb.equiprental.passengerid 
GROUP BY empchann_ntcdivedb.passengerinfo.passengerid 
ORDER BY renttimes DESC";
$rentresult = $conn->query($rentsql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Statistic Report</title>
    <!-- Get Css -->
    <?php require 'linkcsshead.php'; ?>
</head>
<body>
    <?php require 'navbar.php'; ?>
    <div class="container text-center table-responsive">
        <div class="row">
            <div class="col-12">
                <h5>Customer Ranking</h5>
                <table cellspacing="5" cellpadding="5" class="table table-hover table-striped">
                <tbody>
                    <tr class="table-primary">
                        <th class="text-center">PID</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Gender</th>
                        <th class="text-center">#Trips</th>
                        <th class="text-center">Amount Paid</th>

                    </tr>
                    <?php
                        if ($result->num_rows > 0) {
                            $i = 1;
                            while($row = $result->fetch_assoc()){

                                ?>

                        <tr>
                            <td><?php echo $row['passengerid'];?></td>
                            <td><?php echo $row['firstname']; echo " "; echo $row['lastname'];?></td>
                            <td><?php
                                echo colorDisplayCell($row['gender'],'male','female','Male','Female','blue','deeppink');
                            ?> </td>
                            <td><?php echo $row['triptimes'];?></td>
                            <td><?php echo $row['totalprices'];?></td>
                        </tr>       
                    
                <?php
                            $i++;
                        }
                    }
                ?>
                </tbody>
            </table>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-6">
                <h5>Customer Rental Ranking</h5>
                <table cellspacing="5" cellpadding="5" class="table table-hover table-striped">
                <tbody>
                    <tr class="table-primary">
                        <th class="text-center">PID</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Gender</th>
                        <th class="text-center">#Rent</th>

                    </tr>
                    <?php
                        if ($rentresult->num_rows > 0) {
                            $i = 1;
                            while($rentrow = $rentresult->fetch_assoc()){

                                ?>

                        <tr>
                            <td><?php echo $rentrow['passengerid'];?></td>
                            <td><?php echo $rentrow['firstname']; echo " "; echo $row['lastname'];?></td>
                            <td><?php
                                echo colorDisplayCell($rentrow['gender'],'male','female','Male','Female','blue','deeppink');
                            ?> </td>
                            <td><?php echo $rentrow['renttimes'];?></td>
                        </tr>       
                    
                <?php
                            $i++;
                        }
                    }
                ?>
                    </tbody>
                </table>
            </div>
            <div class="col-6">
            <h5>Trip Ranking</h5>
                <table cellspacing="5" cellpadding="5" class="table table-hover table-striped">
                <tbody>
                    <tr class="table-primary">
                        <th class="text-center">TID</th>
                        <th class="text-center">Departure</th>
                        <th class="text-center">#Dives</th>
                        <th class="text-center">#Passenger</th>

                    </tr>
                    <?php
                        if ($tripresult->num_rows > 0) {
                            $i = 1;
                            while($triprow = $tripresult->fetch_assoc()){
                                $ddate = strtotime($triprow['depart_date']);
                                $departdate = date('d/m/Y', $ddate);

                                ?>

                        <tr>
                            <td><?php echo $triprow['tripid'];?></td>
                            <td><?php echo $departdate;?></td>
                            <td><?php
                                echo colorDisplayCell($triprow['type'],'7dives','11dives','7 Dives','11 Dives','blue','red');
                            ?> </td>
                            <td><?php echo $triprow['noPassenger'];?></td>
                        </tr>       
                    
                <?php
                            $i++;
                        }
                    }
                ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
    <hr>
    <div class="container justify-content-center text-center">
        <a role="button" class="btn btn-block btn-danger p-3" href="main.php">Back</a>
    </div>
    <br>


    
    <!-- get css script  -->
    <?php require 'linkscriptbody.php'; ?>
    
    <?php require 'footer.php'; ?>
</body>
</html>