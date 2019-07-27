<html>
<head>
</head>
<body>
Testing connection: 
<?php
// Connection variables
$servername = "localhost";
$username = "c1_ccs";
$password = "TTD123!!!";

// Create connection
$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>
</body>
</html>