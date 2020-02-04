<?php

require_once('connections.php');
require('checksession.php');
include 'src/php/helper.php';

$id = $_GET['id'];
$tripid = trim($_GET['trip']);

// Data Query by id
$sql = "SELECT * FROM empchann_ntcdivedb.equiprental 
inner join empchann_ntcdivedb.passengerinfo on empchann_ntcdivedb.equiprental.passengerid = empchann_ntcdivedb.passengerinfo.passengerid WHERE rent_id='{$id}'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

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
    <title>Edit Rental</title>
    <!-- Get Css -->
    <?php require 'linkcsshead.php'; ?>

</head>
<body>
    <?php require 'navbar.php'; ?>
    <div class="container">
    <h1>Edit Rental</h1>
        <form name="addrental" method="post" action="editrental.php">
            <div class="form-group">
                <label>Trip Code <span style="color:red"><?php echo $tripid?></span></label>
            </div>
            <div class="form-group">
                <label>Passenger<br><h4 style="color:red"><?php echo $row['firstname']." ".$row['lastname'];?></h4></label>
            </div>
            <div class="form-group text-center">
                <label class="h5">Full Set?</label><br>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-success p-4 px-5">
                    <?php
                        echo  defaultRentalChecked($row['fullset'], 'fullset', 'yes', 'Yes');
                    ?>
                    </label>
                    <label class="btn btn-danger p-4 px-5">
                    <?php
                        echo  defaultRentalChecked($row['fullset'], 'fullset', 'no', 'No');
                    ?>
                    </label>
                </div>
            </div>
            <br>
            <div class="row text-center">
            <div class="col-4">
                    <label class="h5">Mask?</label><br>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-success p-3 px-4">
                            <?php
                                echo  defaultRentalChecked($row['mask'], 'mask', 'yes', 'Yes');
                            ?>
                            </label>
                            <label class="btn btn-danger p-3 px-4">
                            <?php
                                echo  defaultRentalChecked($row['mask'], 'mask', 'no', 'No');
                            ?>
                        </label>
                    </div>
                </div>
                <div class="col-4">
                    <label class="h5">Regulator?</label><br>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-success p-3 px-4">
                            <?php
                                echo  defaultRentalChecked($row['regulator'], 'regulator', 'yes', 'Yes');
                            ?>
                            </label>
                            <label class="btn btn-danger p-3 px-4">
                            <?php
                                echo  defaultRentalChecked($row['regulator'], 'regulator', 'no', 'No');
                            ?>
                        </label>
                    </div>
                </div>
                <div class="col-4">
                    <label class="h5">Dive Computer?</label><br>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-success p-3 px-4">
                            <?php
                                echo  defaultRentalChecked($row['divecom'], 'divecom', 'yes', 'Yes');
                            ?>
                        </label>
                        <label class="btn btn-danger p-3 px-4">
                            <?php
                                echo  defaultRentalChecked($row['divecom'], 'divecom', 'no', 'No');
                            ?>
                        </label>
                    </div>
                </div>
            </div>
            <br>
            <div class="form-group text-center">
                <label class="h5">Fins Size?</label><br>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-danger p-3">
                        <?php
                            echo  defaultRentalChecked($row['fins'], 'fins', 'NoRent', 'No Rent');
                        ?>
                    </label>
                    <?php

                        foreach($array_size as $size) {
                            echo "<label class='btn btn-primary p-3 px-4'>";
                            echo defaultRentalChecked($row['fins'], 'fins', $size, $size);
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
                        <?php
                            echo  defaultRentalChecked($row['wetsuit'], 'wetsuit', 'NoRent', 'No Rent');
                        ?>
                    </label>
                    <?php

                        foreach($array_size as $size) {
                            echo "<label class='btn btn-primary p-3 px-4'>";
                            echo defaultRentalChecked($row['wetsuit'], 'wetsuit', $size, $size);
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
                        <?php
                            echo  defaultRentalChecked($row['bcd'], 'bcd', 'NoRent', 'No Rent');
                        ?>
                    </label>
                    <?php

                        foreach($array_size as $size) {
                            echo "<label class='btn btn-primary p-3 px-4'>";
                            echo defaultRentalChecked($row['bcd'], 'bcd', $size, $size);
                            echo "</label>";
                        }

                    ?>
                </div>
            </div>
            <input type="hidden" name="rentid" value="<?php echo $row['rent_id'];?>" /><!-- Send id of edit record -->
            <input type="hidden" name="passengerid" value="<?php echo $row['passengerid'];?>" /><!-- Send id of edit record -->
            <input type="hidden" name="tripid" value="<?php echo $tripid;?>" /><!-- Send id of edit record -->
            <br>
            <div class="text-center">
                <input type="submit" name="submit" value="Submit" class="btn btn-success p-3 px-5" onclick="return confirm('Do you want to submit?')"/>
                <a href="viewtrip.php?id=<?php echo $tripid?>" type="button" class="btn btn-danger p-3 px-5">Back</a>
            </div>
            
        </form>
    </div>

    <!-- get css script  -->
    <?php require 'linkscriptbody.php'; ?>
    
    <?php require 'footer.php'; ?>
</body>
</html>