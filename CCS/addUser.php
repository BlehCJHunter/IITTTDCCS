<?php

require 'includes/session.inc';

foreach ($_POST as $key => $value) {
    ${htmlspecialchars(stripslashes(strip_tags($key)))} = htmlspecialchars(stripslashes(strip_tags($value)));
    echo htmlspecialchars(stripslashes(strip_tags($key))) . "= " . htmlspecialchars(stripslashes(strip_tags($value))) . "<br>";
}
switch ($uType) {
    case "patient":
        if ($search == "Search") {
            $target = "Location: index.php?AUI=4&searchfor=" . $Medno;
            header($target);
            exit();
        }
        if (!$delete && ($_SESSION['access'] == 3 || $_SESSION['access'] == 4 || $_SESSION['dbg'])) {
            require 'admin/includes/dbconnect.inc';
            $AAAAAAA = mysqli_query($conn, ($add ? "SELECT MAX(`Patient ID`) FROM `Patient_Details`" : "SELECT * FROM `Patient_Details`"));
            $AAAAAA = mysqli_fetch_row($AAAAAAA);
            $query = "";
            $query .= $add ? "INSERT INTO `Patient_Details` VALUES ('" : "UPDATE `Patient_Details` SET ";
            $query .= $add ? ($AAAAAA[0] + 1) . "', " : "";
            $query .= ($add ? "'" : "`First Name` = '") . $fName . "', ";
            $query .= ($add ? "'" : "`Last Name` = '") . $lName . "', ";
            $query .= ($add ? "'" : "`Unit No.` = '") . $unit . "', ";
            $query .= ($add ? "'" : "`Street No.` = '") . $addr . "', ";
            $query .= ($add ? "'" : "`Address` = '") . $street . "', ";
            $query .= ($add ? "'" : "`City` = '") . $city . "', ";
            $query .= ($add ? "'" : "`Post Code` = '") . $pCode . "', ";
            $query .= ($add ? "'" : "`DOB` = '") . $DoB . "', ";
            $query .= ($add ? "'" : "`Sex` = '") . $sex . "', ";
            $query .= ($add ? "'" : "`Medicare No.` = '") . $Medno . "', ";
            $query .= ($add ? "'" : "`Medicare IRN` = '") . $MCIRV . ($add ? "') " : "' ");
            $query .= ($add ? "" : "WHERE ");
            $query .= ($add ? "" : "`Patient ID` = '" . $PID . "'");
            if (mysqli_query($conn, $query)) {
                echo "Record " . ($add ? "created" : "updated") . " successfully";
            } else {
                echo "Error: " . $query . "<br>" . mysqli_error($conn);
                $conn->close();
                exit();
            }
            $conn->close();
        } elseif ($delete) {
            require 'admin/includes/dbconnect.inc';
            $query = "";
            $query .= "DELETE FROM `Patient_Details` WHERE ";
            $query .= "`Medicare No.` = '";
            $query .= $Medno . "'";
            if (mysqli_query($conn, $query)) {
                echo "Record deleted successfully";
            } else {
                echo "Error: " . $query . "<br>" . mysqli_error($conn);
                $conn->close();
                exit();
            }
            $conn->close();
        }
        break;

    case "user":
        if ($search == "Search") {
            $target = "Location: index.php?AUI=4&usearchfor=" . $uName;
            header($target);
            exit();
        }
        if (!$delete && ($_SESSION['access'] == 4 || $_SESSION['dbg'])) {
            require 'admin/includes/dbconnect.inc';
            $AAAAAAA = mysqli_query($conn, "SELECT MAX(`User ID`) FROM `Users`"); // I SCREAM. This is the new User ID
            $AAAAAA = mysqli_fetch_row($AAAAAAA); // AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA0x41414141414141
            $query = "";
            $query .= $add ? "INSERT INTO `Users` VALUES ('" : "UPDATE `Users` SET ";
            $query .= $add ? ($AAAAAA[0] + 1) . "', " : "";
            $query .= ($add ? "'" : "`First Name` = '") . $fName . "', ";
            $query .= ($add ? "'" : "`Last Name` = '") . $lName . "', ";
            $query .= ($add ? "'" : "`Position Title` = '") . $title . "', ";
            $query .= ($add ? "'" : "`Access_ID` = '") . $acc . "', ";
            $query .= ($add ? "'" : "`Username` = '") . $uName . "', ";
            $query .= ($add ? "'" . hash("sha512", $uName . "ZYX" . $pWord . "ABC") . "', " : (strlen($pWord) > 1 ? "`Password Token` = '" . hash("sha512", $uName . "ZYX" . $pWord . "ABC") . "', " : ""));
            $query .= ($add ? "'" . date("Y-m-d H:i:s", time()) . "', " : "");
            $query .= ($add ? "'" : "`Email` = '") . $email . "', ";
            $query .= ($add ? "'" : "`Phone Number` = '") . $phone . "'";
            $query .= ($add ? ") " : " WHERE ");
            $query .= ($add ? "" : "`User ID` = '" . $UID . "'");
            if (mysqli_query($conn, $query)) {
                echo "Record " . ($add ? "created" : "updated") . " successfully";
            } else {
                echo "Error: " . $query . "<br>" . mysqli_error($conn);
                $conn->close();
                exit();
            }
            $conn->close();
        } elseif ($delete) {
            require 'admin/includes/dbconnect.inc';
            $query = "";
            $query .= "DELETE FROM `Patient_Details` WHERE ";
            $query .= "`Username` = '";
            $query .= $uName . "'";
            if (mysqli_query($conn, $query)) {
                echo "Record deleted successfully";
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