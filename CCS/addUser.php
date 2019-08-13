<?php

require 'includes/session.inc';

foreach ($_POST as $key => $value) {
    ${htmlspecialchars(stripslashes(strip_tags($key)))} = htmlspecialchars(stripslashes(strip_tags($value)));
}
switch ($uType) {
    case "patient":
        if ($_SESSION['access'] == 3 || $_SESSION['access'] == 4 || $_SESSION['dbg']) {
            
        }
        break;

    case "user":
        if ($_SESSION['access'] == 4 || $_SESSION['dbg']) {
            $query = "";
            $query .= $add ? "INSERT INTO `Users` VALUES ('" : "UPDATE `Users` ";
            $query .= "0', '";
            $query .= $fName . "', '";
            $query .= $lName . "', '";
            $query .= $title . "', '";
            $query .= $acc . "', '";
            $query .= $uName . "', '";
            $query .= hash("sha512", $uName . "ZYX" . $pWord . "ABC") . "', '";
            $query .= $email . "', '";
            $query .= $phone . "')";
            require 'admin/includes/dbconnect.inc';
            if (mysqli_query($conn, $query)) {
                echo "Record " . ($add ? "created" : "updated") . " successfully";
            } else {
                echo "Error: " . $query . "<br>" . mysqli_error($conn);
                $conn->close();
                exit();
            }
            $conn->close();
        }
        break;

    default:
        break;
}
header("Location: index.php");
?>