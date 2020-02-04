<?php

require_once('connections.php');
require('checksession.php');
include 'src/php/helper.php';

$sql = "SELECT * FROM empchann_ntcdivedb.passengerinfo";
$result = $conn->query($sql);

$sql2 = "SELECT * FROM empchann_ntcdivedb.roomtype";
$result2 = $conn->query($sql2);

$id = trim($_GET['id']);

$sql3 = "SELECT * FROM empchann_ntcdivedb.trip_passenger 
inner join empchann_ntcdivedb.passengerinfo on empchann_ntcdivedb.trip_passenger.passengerid = empchann_ntcdivedb.passengerinfo.passengerid 
inner join empchann_ntcdivedb.roomtype on empchann_ntcdivedb.trip_passenger.roomtype = empchann_ntcdivedb.roomtype.roomid 
inner join empchann_ntcdivedb.tripdetail on empchann_ntcdivedb.trip_passenger.tripid = empchann_ntcdivedb.tripdetail.tripid 
WHERE empchann_ntcdivedb.trip_passenger.tripid='{$id}' ORDER BY empchann_ntcdivedb.roomtype.roomid";

$result3 = $conn->query($sql3);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Pragma" content="no-cache"/>
    <meta http-equiv="Cache-Control" content="no-cache"/>
    <title>Add Customer to Trip ID <?php echo $id?></title>
    <!-- Get Css -->
    <?php require 'linkcsshead.php'; ?>

</head>
<body>
    <?php require 'navbar.php'; ?>
    <div class="container">
    <h1>Add Customer to Trip ID <span class="text-danger"><?php echo $id?></span></h1>
    <hr>
        <form name="addcustomer" method="post" action="custtotripsql.php">
            <div class="form-group">
                <label class="h5">Customer</label>
                <br>
                <select class="form-control" name="passengerid">
                <?php
                        if ($result->num_rows > 0) {
                            $i = 1;
                            while($row = $result->fetch_assoc()){
                                ?>
                            <option value="<?php echo $row["passengerid"];?>"><?php echo $row["passengerid"]." - ".$row["firstname"]." ".$row["lastname"];?></option>
                <?php
                            $i++;
                        }
                    }
                ?>
                </select>
            </div>
            <div class="form-group">
                <label class="h5">Room</label>
                <br>
                <select class="form-control" name="roomid">
                <?php
                        if ($result2->num_rows > 0) {
                            $i = 1;
                            while($row2 = $result2->fetch_assoc()){
                                ?>
                            <option value="<?php echo $row2["roomid"];?>"><?php
                            echo switchRoomName($row2["roomname"]);
                            ?></option>
                <?php
                            $i++;
                        }
                    }
                ?>
                </select>
            </div>
            <input type="hidden" name="tripid" value="<?php echo $id;?>" /><!-- Send id of edit record -->
            <br>
            <div class="row">
                <div class="col-6">
                    <input type="submit" name="submit" value="Submit" class="btn btn-success p-3 px-5" onclick="return confirm('Do you want to submit?')"/>
                    <a href="viewtrip.php?id=<?php echo $id?>" type="button" class="btn btn-danger p-3 px-5">Back</a>
                </div>
                <div class="col-6">
                </div>
            </div>
        </form>
        <hr>
        <div class="container justify-content-center text-center table-responsive">
        <h3>Current Room for Trip ID <span style="color:red"><?php echo $id;?></span></h3>
        <br>
            <table cellspacing="5" cellpadding="5" class="table table-hover">
                <tbody>
                    <tr class="table-primary">
                        <th class="text-center">PID</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Gender</th>
                        <th class="text-center">Room</th>

                    </tr>
                    <?php
                        if ($result3->num_rows > 0) {
                            $i = 1;
                            while($row = $result3->fetch_assoc()){
                                ?>

                        <tr>
                            <td><?php echo $row['passengerid'];?></td>
                            <td><?php echo $row['firstname']; echo " "; echo $row['lastname'];?></td>
                            <td><?php
                            if ($row['gender'] == "male"){
                                echo '<span style="color:blue;text-align:center;">Male</span>';
                            } elseif ($row['gender'] == "female") {
                                echo '<span style="color:deeppink;text-align:center;">Female</span>';
                            } else {
                                echo "Other";
                            }
                            ?> </td>
                            <td><?php
                                echo switchRoomNameColor($row["roomname"]);
                            ?></td>
                        </tr>       
                    </tbody>
                <?php
                            $i++;
                        }
                    }
                ?>
            </table>
                </div>
    </div>

    <!-- get css script  -->
    <?php require 'linkscriptbody.php'; ?>
    
    
</body>
</html>