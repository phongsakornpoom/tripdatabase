<?php

require_once('connections.php');
require('checksession.php');

$id = trim($_GET['id']);

$sql = "SELECT * FROM empchann_ntcdivedb.passengerinfo 
inner join empchann_ntcdivedb.trip_passenger 
on empchann_ntcdivedb.trip_passenger.passengerid = empchann_ntcdivedb.passengerinfo.passengerid 
WHERE empchann_ntcdivedb.trip_passenger.tripid ='{$id}'";
$result = $conn->query($sql);

$array_size = array("XS","S","M","L","XL","XXL");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Pragma" content="no-cache"/>
    <meta http-equiv="Cache-Control" content="no-cache"/>
    <title>Add Rental</title>
    <!-- Get Css -->
    <?php require 'linkcsshead.php'; ?>

</head>
<body>
    <?php require 'navbar.php'; ?>
    <div class="container">
    <h1>Add Rental for Trip Code <span style="color:red"><?php echo $id?></span></h1>
    <br>
        <form name="addrental" method="post" action="addrentalsql.php">
            <div class="form-group">
                <label class="h5">Select Passenger</label><br>
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
            <hr>
            <div class="form-group text-center">
                <label class="h5">Full Set?</label><br>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-success p-4 px-5">
                        <input type="radio" name="fullset" value="yes" checked> Yes<br>
                    </label>
                    <label class="btn btn-danger p-4 px-5">
                        <input type="radio" name="fullset" value="no"> No<br>
                    </label>
                </div>
            </div>
            <br>
            <div class="row text-center">
                <div class="col-4">
                    <label class="h5">Mask?</label><br>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-success p-3 px-4">
                            <input type="radio" name="mask" value="yes" checked> Yes<br>
                        </label>
                        <label class="btn btn-danger p-3 px-4">
                            <input type="radio" name="mask" value="no"> No<br>
                        </label>
                    </div>
                </div>
                <div class="col-4">
                    <label class="h5">Regulator?</label><br>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-success p-3 px-4">
                            <input type="radio" name="regulator" value="yes" checked> Yes<br>
                        </label>
                        <label class="btn btn-danger p-3 px-4">
                            <input type="radio" name="regulator" value="no"> No<br>
                        </label>
                    </div>
                </div>
                <div class="col-4">
                    <label class="h5">Dive Computer?</label><br>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-success p-3 px-4">
                            <input type="radio" name="divecom" value="yes" checked> Yes<br>
                        </label>
                        <label class="btn btn-danger p-3 px-4">
                            <input type="radio" name="divecom" value="no"> No<br>
                        </label>
                    </div>
                </div>
            </div>
            <br>
            <div class="form-group text-center">
                <label class="h5">Fins Size?</label><br>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-danger p-3">
                        <input type="radio" name="fins" value="NoRent" checked> No Rent<br>
                    </label>
                    <?php

                        foreach($array_size as $size) {
                            echo "<label class='btn btn-primary p-3 px-4'>";
                            echo "<input type='radio' name='fins' value='$size'> $size<br>";
                            echo "</label>";
                        }

                    ?>
                </div>
            </div>
            <br>
            <div class="form-group text-center">
                <label class="h5">Wetsuit Size?</label><br>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-danger p-3">
                        <input type="radio" name="wetsuit" value="NoRent" checked> No Rent<br>
                    </label>
                    <?php

                        foreach($array_size as $size) {
                            echo "<label class='btn btn-primary p-3 px-4'>";
                            echo "<input type='radio' name='wetsuit' value='$size'> $size<br>";
                            echo "</label>";
                        }

                    ?>
                </div>
            </div>
            <br>
            <div class="form-group text-center">
                <label class="h5">BCD Size?</label><br>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-danger p-3">
                        <input type="radio" name="bcd" value="NoRent" checked> No Rent<br>
                    </label>
                    <?php

                        foreach($array_size as $size) {
                            echo "<label class='btn btn-primary p-3 px-4'>";
                            echo "<input type='radio' name='bcd' value='$size'> $size<br>";
                            echo "</label>";
                        }

                    ?>
                </div>
            </div>
            <input type="hidden" name="tripid" value="<?php echo $id;?>" /><!-- Send id of edit record -->
            <br>
            <div class="text-center">
                <input type="submit" name="submit" value="Submit" class="btn btn-success p-3 px-5" onclick="return confirm('Do you want to submit?')"/>
                <a href="viewtrip.php?id=<?php echo $id?>" type="button" class="btn btn-danger p-3 px-5">Back</a>
            </div>
            

        </form>
    </div>

    <!-- get css script  -->
    <?php require 'linkscriptbody.php'; ?>
    
</body>
</html>