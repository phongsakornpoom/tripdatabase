<?php
	session_start();

	require_once("connections.php");
	
	$strUsername = mysqli_real_escape_string($conn,$_POST['txtUsername']);
	$strPassword = mysqli_real_escape_string($conn,$_POST['txtPassword']);
	$hashPwd = password_verify($_POST['txtPassword'], PASSWORD_BCRYPT);

	$strSQL = "SELECT * FROM account WHERE username = '".$strUsername."' 
	and password = '".$strPassword."'";
	$objQuery = mysqli_query($conn,$strSQL);
	$objResult = mysqli_fetch_array($objQuery);
	if(!$objResult)
	{
		echo "Username and Password Incorrect!";
		echo $strUsername;
		echo $hashPwd;
		exit();
	}
	else
	{
		if($objResult["LoginStatus"] == "1")
		{
			echo "'".$strUsername."' Exists login!";
			header("location:main.php");
			exit();
		}
		else
		{
			//*** Update Status Login
			$sql = "UPDATE account SET LoginStatus = '1' , LastUpdate = NOW() WHERE userid = '".$objResult["userid"]."' ";
			$query = mysqli_query($conn,$sql);

			//*** Session
			$_SESSION["userid"] = $objResult["userid"];
			session_write_close();

			//*** Go to Main page
			header("location:main.php");
		}
			
	}
	mysqli_close($conn);
?>