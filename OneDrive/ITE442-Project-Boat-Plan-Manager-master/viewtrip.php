<?php

require_once('connections.php');
require('checksession.php');
include 'src/php/helper.php';

$id = $_GET['id'];

$sql = "SELECT * FROM empchann_ntcdivedb.trip_passenger 
inner join empchann_ntcdivedb.passengerinfo on empchann_ntcdivedb.trip_passenger.passengerid = empchann_ntcdivedb.passengerinfo.passengerid 
inner join empchann_ntcdivedb.roomtype on empchann_ntcdivedb.trip_passenger.roomtype = empchann_ntcdivedb.roomtype.roomid 
inner join empchann_ntcdivedb.tripdetail on empchann_ntcdivedb.trip_passenger.tripid = empchann_ntcdivedb.tripdetail.tripid 
WHERE empchann_ntcdivedb.trip_passenger.tripid='{$id}' ORDER BY empchann_ntcdivedb.roomtype.roomid";

$result = $conn->query($sql);

$sql2 = "SELECT * FROM empchann_ntcdivedb.equiprental 
inner join empchann_ntcdivedb.tripdetail on empchann_ntcdivedb.equiprental.tripid = empchann_ntcdivedb.tripdetail.tripid 
inner join empchann_ntcdivedb.passengerinfo on empchann_ntcdivedb.equiprental.passengerid = empchann_ntcdivedb.passengerinfo.passengerid 
WHERE empchann_ntcdivedb.equiprental.tripid='{$id}'";
$result2 = $conn->query($sql2);

$rentItems = array("fullset","mask","regulator","divecom");
$rentItems2 = array("fins","wetsuit","bcd");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trip ID <?php echo $id;?></title>
    <!-- Get Css -->
    <?php require 'linkcsshead.php'; ?>
</head>
<body>
    <?php require 'navbar.php'; ?>
    <div class="container justify-content-center text-center table-responsive">
        <div class="row">
            <div class="col-9">
                <p class="display-4 text-left text-uppercase">Customer List for Trip ID <span style="color:red"><?php echo $id;?></span></p>
            </div>
            <div class="col-3">
                <a role="button" class="btn btn-primary btn-lg" href="addcusttotrip.php?id=<?php echo $id;?>">Add Customer</a>
            </div>
        </div>
        <br>
        <table cellspacing="5" cellpadding="5" class="table table-hover table-striped">
            <tbody>
                <tr class="table-primary">
                    <th class="text-center">PID</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Gender</th>
                    <th class="text-center">Phone</th>
                    <th class="text-center">Level</th>
                    <th class="text-center">Room</th>
                    <th colspan=2 class="text-center">Action</th>

                </tr>
                <?php
                    if ($result->num_rows > 0) {
                        $i = 1;
                        while($row = $result->fetch_assoc()){
                            $ldive = strtotime($row['lastdive']);
                            $lastdive = date('d/m/Y', $ldive);
                            ?>

                    <tr>
                        <td><?php echo $row['passengerid'];?></td>
                        <td><?php echo $row['firstname']; echo " "; echo $row['lastname'];?></td>
                        <td><?php

                            echo colorDisplayCell($row['gender'],'male','female','Male','Female','blue','deeppink');

                        ?> </td>
                        <td><?php echo $row['phone'];?></td>
                        <td><?php echo $row['certlevel'];?></td>
                        <td>
                        <?php
                        echo switchRoomNameColor($row["roomname"]);
                        ?>
                        </td>
                        <td>
                            <a href="editcusttriproom.php?id=<?php echo $row['passengerid'];?>&trip=<?php echo $id;?>&room=<?php echo $row['roomid'];?>" class="btn btn-warning">Edit Room</a>&nbsp;
                        </td>
                        <td>
                            <a href="deletecustfromtrip.php?id=<?php echo $row['passengerid'];?>&trip=<?php echo $id;?>" class="btn btn-danger">Delete</a>
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
    <hr>
    <br>
    <div class="container justify-content-center text-center table-responsive">
        <div class="row">
            <div class="col-9">
                <p class="display-4 text-left text-uppercase">Equipment Rental List</p>
            </div>
            <div class="col-3">
                <a role="button" class="btn btn-primary btn-lg" href="addrentalform.php?id=<?php echo $id;?>">Add Rental</a>
            </div>
        </div>
        <table class="table table-hover table-striped">
            <tbody>
                <tr class="table-danger">
                    <th class="text-center">RID</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Full Set</th>
                    <th class="text-center">Mask</th>
                    <th class="text-center">Regulator</th>
                    <th class="text-center">Dive Com</th>
                    <th class="text-center">Fins (Size)</th>
                    <th class="text-center">Wetsuit (Size)</th>
                    <th class="text-center">BCD (Size)</th>
                    <th colspan=2 class="text-center">Edit</th>
                </tr>
                <?php
                        if ($result2->num_rows > 0) {
                            $i = 1;
                            while($row = $result2->fetch_assoc()){
                                
                                ?>

                        <tr>
                            <td><?php echo $row['rent_id'];?></td>
                            <td><?php echo $row['firstname']; echo " "; echo $row['lastname'];?></td>
                            <?php
                                foreach ($rentItems as $item){
                                    echo "<td>",colorDisplayCell($row[$item],'yes','no','Yes','No','forestgreen','red'),"</td>";
                                }
                            
                                foreach ($rentItems2 as $item2){
                                    if ($row[$item2] == "NoRent") {
                                        echo "<td class='text-danger'>No Rent</td>";
                                    } else {
                                        echo "<td>",$row[$item2],"</td>";
                                    }
                                }
                            ?>
                            <td>
                                <a href="editrent_form.php?id=<?php echo $row['rent_id'];?>&trip=<?php echo $id;?>" class="btn btn-warning">Edit</a>&nbsp;
                            </td>
                            <td>
                                <a href="deleterent.php?id=<?php echo $row['rent_id'];?>&trip=<?php echo $id;?>" class="btn btn-danger">Delete</a>
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
    <hr>
    <br>
    <div class="container justify-content-center text-center">
        <a role="button" class="btn btn-block btn-danger p-3" href="main.php">Back</a>
    </div>
    <br>
    <!-- get css script  -->
    <?php require 'linkscriptbody.php'; ?>
    
    <?php
        $conn->close();// ปิด Connection
    ?>  

    <?php require 'footer.php'; ?>
</body>
</html>