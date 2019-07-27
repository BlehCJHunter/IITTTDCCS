<?php
$DBServer = 'localhost';
$DBUser = 'c1_ccs';
$DBPass = 'TTD123!!!';
$DBName = 'c1_ccs';
$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
?>