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
    <title>Login</title>
    <!-- Get Css -->
    <?php require 'linkcsshead.php'; ?>
</head>
<body>
    <br><br><br>
    <div class="container">
    <h1 class="text-uppercase text-center">Login</h1>
    <br>
        <form name="changepwd_form" method="post" action="change_pwdsql.php">
            <div class="form-group">
                <label>New Passsword</label>
                <input type="password" class="form-control" name="pwd" id="pwd" placeholder=" NewPasssword" required>
            </div>
            <input type="hidden" name="userid" value="<?php echo $objResult["userid"];?>" /><!-- Send id of edit record -->
            <input type="submit" name="submit" value="Submit" class="btn btn-success p-3 px-5"/>
        </form>
    </div>

    <?php require 'linkscriptbody.php'; ?>
</body>
</html>