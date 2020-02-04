<?php

require_once('connections.php');
require('checksession.php');
include 'src/php/helper.php';

$sql = "SELECT * FROM empchann_ntcdivedb.tripdetail";
$result = $conn->query($sql);

$sql2 = "SELECT * FROM empchann_ntcdivedb.passengerinfo";
$result2 = $conn->query($sql2);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>NTCDive Boat Plan Management</title>
    <!-- Get Css -->
    <?php require 'linkcsshead.php'; ?>

</head>
<body>
    <?php require 'navbar.php'; ?>

    <div class="container justify-content-center text-center table-responsive">
        <div class="row">
            <div class="col-10">
                <p class="display-4 text-left text-uppercase">Trip List</p>
            </div>
            <div class="col-2">
                <a role="button" class="btn btn-primary btn-lg" href="addtrip.php">Add Trip</a>
            </div>
        </div>
            <table cellspacing="5" cellpadding="5" class="table table-hover table-striped">
                <tbody>
                    <tr class="table-primary">
                        <th class="text-center">TID</th>
                        <th class="text-center">Departure</th>
                        <th class="text-center">Destination</th>
                        <th class="text-center">#Dives</th>
                        <th class="text-center">View</th>
                        <th class="text-center">Edit</th>
                        <th class="text-center">Delete</th>

                    </tr>
                    <?php
                        // If it has data, show the data.
                        if ($result->num_rows > 0) {
                            $i = 1;
                            while($row = $result->fetch_assoc()){
                                $ddate = strtotime($row['depart_date']);
                                $departdate = date('d/m/Y', $ddate);
                                ?>

                        <tr>
                            <td><?php echo $row['tripid'];?></td>
                            <td><?php echo $departdate;?></td>
                            <td><?php echo $row['destination'];?></td>
                            <td><?php
                            echo colorDisplayCell($row['type'],'7dives','11dives','7 Dives','11 Dives','blue','red');
                            ?></td>
                            <td>
                                <a href="viewtrip.php?id=<?php echo $row['tripid'];?>" class="btn btn-info">View</a>&nbsp;
                            </td>
                            <td>
                                <a href="edittrip.php?id=<?php echo $row['tripid'];?>" class="btn btn-warning">Edit</a>&nbsp;
                            </td>
                            <td>
                                <a href="deletetrip.php?id=<?php echo $row['tripid'];?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>   
                <?php
                            $i++;
                        }
                    }
                ?>
                    
                </tbody>
            </table>
    </div>
    <br>
    <hr>
    <br>
    <div class="container justify-content-center text-center table-responsive">
        <div class="row">
            <div class="col-9">
                <p class="display-4 text-left text-uppercase">Customer List</p>
            </div>
            <div class="col-3">
                <a role="button" class="btn btn-primary btn-lg" href="addcustomer.php">Add Customer</a>
            </div>
        </div>
            <table cellspacing="5" cellpadding="5" class="table table-hover table-striped">
                <tbody>
                    <tr class="table-primary">
                        <th class="text-center">PID</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Gender</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Phone</th>
                        <th class="text-center">Cert Level</th>
                        <th class="text-center">Agency</th>
                        <th class="text-center">Last Dived</th>
                        <th class="text-center">Total Dives</th>
                        <th class="text-center">Edit</th>
                        <th class="text-center">Delete</th>

                    </tr>
                    <?php
                        if ($result2->num_rows > 0) {
                            $i = 1;
                            while($row = $result2->fetch_assoc()){
                                $ldive = strtotime($row['lastdive']);
                                $lastdive = date('d/m/Y', $ldive);
                                ?>

                        <tr>
                            <td><?php echo $row['passengerid'];?></td>
                            <td><?php echo $row['firstname']; echo " "; echo $row['lastname'];?></td>
                            <td><?php
                                echo colorDisplayCell($row['gender'],'male','female','Male','Female','blue','deeppink');
                            ?> </td>
                            <td><?php echo $row['email'];?></td>
                            <td><?php echo $row['phone'];?></td>
                            <td><?php echo $row['certlevel'];?></td>
                            <td><?php echo $row['certagent'];?></td>
                            <td><?php echo $lastdive;?></td>
                            <td><?php echo $row['nodive'];?></td>
                            <td>
                                <a href="editcust_form.php?id=<?php echo $row['passengerid'];?>" class="btn btn-warning">Edit</a>&nbsp;
                            </td>
                            <td>
                                <a href="deletecust.php?id=<?php echo $row['passengerid'];?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>  
                <?php
                            $i++;
                        }
                    }
                ?>     
                </tbody>
            </table>
    </div>

    <!-- get css script  -->
    <?php require 'linkscriptbody.php'; ?>
    
    <?php require 'footer.php'; ?>
    
    <?php
        $conn->close();// ปิด Connection
    ?>  
</body>
</html>