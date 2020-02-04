<?php
// Connection with Database
// The information on actual server is edited out
$servername = "localhost";
$username = "user";
$password = "password";
$dbname = "empchann_ntcdivedb";

// Create the Connection
$conn = new mysqli($servername, $username, $password, $dbname); // mySQL Connection


// Verify Connection
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error); // Fail
}

// If Connection is established
// echo "Connction Successfully"; // OK

//*** Reject user not online
$intRejectTime = 20; // Minute
$sql = "UPDATE account SET LoginStatus = '0', LastUpdate = '0000-00-00 00:00:00'  WHERE 1 AND DATE_ADD(LastUpdate, INTERVAL $intRejectTime MINUTE) <= NOW() ";
$query = mysqli_query($conn,$sql);

?>