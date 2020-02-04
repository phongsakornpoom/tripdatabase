<?php
	session_start();
	require_once("connections.php");

	if(!isset($_SESSION['userid']))
	{
		echo "Please Login!";
		header("location:index.php");
		exit();
	}
	
	//*** Update Last Stay in Login System
	$sql = "UPDATE account SET LastUpdate = NOW() WHERE userid = '".$_SESSION["userid"]."' ";
	$query = mysqli_query($conn,$sql);

	//*** Get User Login
	$strSQL = "SELECT * FROM account WHERE userid = '".$_SESSION['userid']."' ";
	$objQuery = mysqli_query($conn,$strSQL);
	$objResult = mysqli_fetch_array($objQuery,MYSQLI_ASSOC);
?>