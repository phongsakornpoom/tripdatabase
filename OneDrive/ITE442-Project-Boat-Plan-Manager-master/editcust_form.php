<?php

require_once('connections.php');
require('checksession.php');
include 'src/php/helper.php';

$id = $_GET['id'];

// Data Query by id
$sql = "SELECT * FROM empchann_ntcdivedb.passengerinfo WHERE passengerid='{$id}'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$array_lastdive = explode('-', $row['lastdive']);
$year = $array_lastdive[0];
$month = $array_lastdive[1];
$day = $array_lastdive[2];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Pragma" content="no-cache"/>
    <meta http-equiv="Cache-Control" content="no-cache"/>
    <title>Edit Customer ID <?php echo $id ?></title>
    <!-- Get Css -->
    <?php require 'linkcsshead.php'; ?>

</head>
<body>
    <?php require 'navbar.php'; ?>
    <div class="container">
    <h1>Edit Customer ID <span class="text-danger"><?php echo $id ?></span></h1>
    <hr>
        <form name="editcustomer" method="post" action="editcustomer.php">

            
            <div class="row">
                <div class="col-8">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" name="firstname" placeholder="First Name" value="<?php echo $row['firstname'];?>" required>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label>Middle Name</label>
                        <input type="text" class="form-control" name="middlename" placeholder="Middle Name (Optional)" value="<?php echo $row['middlename'];?>">
                    </div> 
                </div>
            </div>
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" class="form-control" name="lastname" placeholder="Last Name" value="<?php echo $row['lastname'];?>" required>
            </div>
            <div class="form-group text-center">
                <label>Gender</label><br>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-primary p-3 px-4">
                        <?php
                            echo  defaultRentalChecked($row['gender'], 'gender', 'male', 'Male');
                        ?>
                    </label>
                    <label class="btn btn-primary p-3 px-4">
                        <?php
                            echo  defaultRentalChecked($row['gender'], 'gender', 'female', 'Female');
                        ?>
                    </label>
                    <label class="btn btn-primary p-3 px-4">
                        <?php
                            echo  defaultRentalChecked($row['gender'], 'gender', 'other', 'Other');
                        ?>
                    </label>
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" placeholder="abc@def.com" value="<?php echo $row['email'];?>">
                    </div>
                </div>
                
                <div class="col-6">
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" class="form-control" name="phone" placeholder="099-999-9999" value="<?php echo $row['phone'];?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label>Line ID</label>
                    <input type="text" class="form-control" name="lineid" placeholder="Line ID" value="<?php echo $row['lineid'];?>">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Facebook</label>
                    <input type="text" class="form-control" name="facebook" placeholder="http://www.facebook.com/lorem" value="<?php echo $row['facebook'];?>">
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label>Diver Certificate Level</label>
                        <select class="form-control" name="certlevel">
                        <option selected value="<?php echo $row['certlevel'];?>"><?php echo $row['certlevel'];?> (Current)</option>
                        <option>OW</option>
                        <option>AOW</option>
                        <option>Rescue</option>
                        <option>DM</option>
                        <option>IN</option>
                        <option>Other</option>
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Diver Agency</label>
                        <select class="form-control" name="certagent">
                        <option selected value="<?php echo $row['certagent'];?>"><?php echo $row['certagent'];?> (Current)</option>
                        <option>PADI</option>
                        <option>NAUI</option>
                        <option>SSI</option>
                        <option>BSAC</option>
                        <option>Other</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Diver Number</label>
                <input type="text" class="form-control" name="certno" placeholder="Diver Number" value="<?php echo $row['certno'];?>">
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label>Total Dives</label>
                        <input type="text" class="form-control" name="totaldives" placeholder="000" value="<?php echo $row['nodive'];?>">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Last dived</label>
                        <br>
                        <select name="day" style="height: 40px;" class="px-2">
                            <?php
                                $showday = switchDayName($day);
                                $showmonth = switchMonthName($month);
                            ?>
                            <option selected value="<?php echo $showday;?>"><?php echo $showday;?> (Current)</option>
                            <?php for($d=1; $d<=31; $d++){ ?>
                                <option value="<?php echo $d;?>"><?php echo $d;?></option>
                            <?php } ?>
                        </select>
                        <select name="month" style="height: 40px;" class="px-2">
                            <option selected value="<?php echo $month;?>"><?php echo $showmonth;?> (Current)</option>
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
                        <select name="year" style="height: 40px;" class="px-2">
                            <option value="<?php echo $year;?>"><?php echo $year;?> (Current)</option>
                            <?php for($y=date('Y'); $y>=(date('Y')-50); $y--){ ?>
                                <option value="<?php echo $y;?>"><?php echo $y;?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <hr>
            <div class="form-group">
                <label>Notes</label>
                <input type="text" class="form-control" name="notes" placeholder="Additional Notes" value="<?php echo $row['notes'];?>">
            </div>
            <input type="hidden" name="id" value="<?php echo $row['passengerid'];?>" /><!-- Send id of edit record -->
            <br>
            <div class="row">
                <div class="col-6">
                    <input type="submit" name="submit" value="Submit" class="btn btn-success p-3 px-5" onclick="return confirm('Do you want to submit?')"/>
                    <a href="main.php" type="button" class="btn btn-danger p-3 px-5">Back</a>
                </div>
                <div class="col-6">
                </div>
            </div>
        </form>
        <br>
    </div>

    <!-- get css script  -->
    <?php require 'linkscriptbody.php'; ?>
    
    <?php require 'footer.php'; ?>
</body>
</html>