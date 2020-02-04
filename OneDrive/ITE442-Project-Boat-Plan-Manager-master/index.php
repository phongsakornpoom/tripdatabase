<?php

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
        <form name="login_form" method="post" action="check_login.php">
            <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" name="txtUsername" id="txtUsername" placeholder="Username" required>
            </div>
            <div class="form-group">
                <label>Passsword</label>
                <input type="password" class="form-control" name="txtPassword" id="txtPassword" placeholder="Passsword" required>
            </div>
            <input type="submit" name="submit" value="Login" class="btn btn-success p-3 px-5"/>
        </form>
    </div>

    <?php require 'linkscriptbody.php'; ?>
</body>
</html>