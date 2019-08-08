<?php
$origin = $_REQUEST['origin'];
$compare = $_REQUEST['value'];
require '/admin/includes/dbconnect.inc';
$query = "";
$result = mysqli_query($conn, $query);
$conn->close();
echo $result;

?>