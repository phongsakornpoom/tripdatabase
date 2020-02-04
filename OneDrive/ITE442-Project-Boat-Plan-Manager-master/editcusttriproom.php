<?php

require_once('connections.php');
require('checksession.php');
include 'src/php/helper.php';

$id = trim($_GET['id']);
$tripid = trim($_GET['trip']);
$roomid = trim($_GET['room']);

$sql = "SELECT * FROM empchann_ntcdivedb.passengerinfo WHERE passengerid = '{$id}'";
$result = $conn->query($sql);

$sql2 = "SELECT * FROM empchann_ntcdivedb.roomtype";
$result2 = $conn->query($sql2);

$sql3 = "SELECT * FROM empchann_ntcdivedb.trip_passenger 
inner join empchann_ntcdivedb.passengerinfo on empchann_ntcdivedb.trip_passenger.passengerid = empchann_ntcdivedb.passengerinfo.passengerid 
inner join empchann_ntcdivedb.roomtype on empchann_ntcdivedb.trip_passenger.roomtype = empchann_ntcdivedb.roomtype.roomid 
inner join empchann_ntcdivedb.tripdetail on empchann_ntcdivedb.trip_passenger.tripid = empchann_ntcdivedb.tripdetail.tripid 
WHERE empchann_ntcdivedb.trip_passenger.tripid='{$tripid}' ORDER BY empchann_ntcdivedb.roomtype.roomid";

$result3 = $conn->query($sql3);

$sql4 = "SELECT * FROM empchann_ntcdivedb.roomtype
WHERE empchann_ntcdivedb.roomtype.roomid ='{$roomid}'";
$result4 = $conn->query($sql4);
$row4 = $result4->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Pragma" content="no-cache"/>
    <meta http-equiv="Cache-Control" content="no-cache"/>
    <title>Edit Customer Room</title>
    <!-- Get Css -->
    <?php require 'linkcsshead.php'; ?>

</head>
<body>
    <?php require 'navbar.php'; ?>
    <div class="container">
    <h1>Edit Customer Room</h1>
        <form name="editcustomerroom" method="post" action="editcustroomsql.php">
            <div class="form-group">
                <label class="h4">Customer</label>
            
                <?php
                        if ($result->num_rows > 0) {
                            $i = 1;
                            while($row = $result->fetch_assoc()){
                                ?>
                            <h3 class="text-danger"><?php echo $row["firstname"]." ".$row["lastname"];?></h3>
                            <h3>Gender: <?php
                            if ($row['gender'] == "male"){
                                echo '<span style="color:blue;text-align:center;">Male</span>';
                            } elseif ($row['gender'] == "female") {
                                echo '<span style="color:deeppink;text-align:center;">Female</span>';
                            } else {
                                echo "Other";
                            }
                            ?></h3>
                <?php
                            $i++;
                        }
                    }
                ?>
            </div>
            <br>
            <div class="form-group">
                <label class="h5">Room</label>
                <br>
                <select class="form-control" name="roomid">
                <option value="<?php echo $row4["roomid"];?>">
                    <?php echo switchRoomName($row4["roomname"]);?> (Current)
                </option>
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
            <br>
            <input type="hidden" name="passengerid" value="<?php echo $id;?>" /><!-- Send id of edit record -->
            <input type="hidden" name="tripid" value="<?php echo $tripid;?>" /><!-- Send id of edit record -->
            <br>
            <div class="row">
                <div class="col-6">
                    <input type="submit" name="submit" value="Submit" class="btn btn-success p-3 px-5" onclick="return confirm('Do you want to submit?')"/>
                    <a href="viewtrip.php?id=<?php echo $tripid?>" type="button" class="btn btn-danger p-3 px-5">Back</a>
                </div>
                <div class="col-6">
                </div>
            </div>
        </form>
        <hr>
        <div class="container justify-content-center text-center table-responsive">
        <h3>Current Room for Trip ID <span style="color:red"><?php echo $tripid;?></span></h3>
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
                        if ($result->num_rows > 0) {
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
                            switch ($row['roomname']) {
                                case "master1":
                                    echo '<span style="color:blue;text-align:center;">Master Cabin Bed 1</span>';
                                    break;
                                case "master2":
                                    echo '<span style="color:blue;text-align:center;">Master Cabin Bed 2</span>';
                                    break;
                                case "master3":
                                    echo '<span style="color:blue;text-align:center;">Master Cabin Bed 3</span>';
                                    break;
                                case "deluxe1":
                                    echo '<span style="color:green;text-align:center;">Deluxe Cabin 1 Bed 1</span>';
                                    break;
                                case "deluxe2":
                                    echo '<span style="color:green;text-align:center;">Deluxe Cabin 1 Bed 2</span>';
                                    break;
                                case "deluxe3":
                                    echo '<span style="color:forestgreen;text-align:center;">Deluxe Cabin 2 Bed 1</span>';
                                    break;
                                case "deluxe4":
                                    echo '<span style="color:forestgreen;text-align:center;">Deluxe Cabin 2 Bed 2</span>';
                                    break;
                                case "superior1":
                                    echo '<span style="color:red;text-align:center;">Superior Cabin 1 Bed 1</span>';
                                    break;
                                case "superior2":
                                    echo '<span style="color:red;text-align:center;">Superior Cabin 1 Bed 2</span>';
                                    break;
                                case "superior3":
                                    echo '<span style="color:maroon;text-align:center;">Superior Cabin 2 Bed 1</span>';
                                    break;
                                case "superior4":
                                    echo '<span style="color:maroon;text-align:center;">Superior Cabin 2 Bed 2</span>';
                                    break;
                                case "superior5":
                                    echo '<span style="color:orangered;text-align:center;">Superior Cabin 3 Bed 1</span>';
                                    break;
                                case "superior6":
                                    echo '<span style="color:orangered;text-align:center;">Superior Cabin 3 Bed 2</span>';
                                    break;
                                case "superior7":
                                    echo '<span style="color:firebrick;text-align:center;">Superior Cabin 4 Bed 1</span>';
                                    break;
                                case "superior8":
                                    echo '<span style="color:firebrick;text-align:center;">Superior Cabin 4 Bed 2</span>';
                                    break;

                            }
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