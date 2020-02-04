<?php
	session_start();

	require_once("connections.php");

	//*** Update Status
	$sql = "UPDATE account SET LoginStatus = '0', LastUpdate = '0000-00-00 00:00:00' WHERE userid = '".$_SESSION["userid"]."' ";
	$query = mysqli_query($conn,$sql);

	session_destroy();
	header("location:index.php");
?>