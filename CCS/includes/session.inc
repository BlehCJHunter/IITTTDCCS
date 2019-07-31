<?php

session_start();
if ($_SESSION['active'] != "1") {
    header("Location: https://ccs.geekrunner.net/CCS/login.php");
    exit();
} else {
    if (!_SESSION['loaded'] || empty(_SESSION['loaded'])) {
        require 'admin/includes/dbconnect.inc';
        $query = "SELECT * FROM Users WHERE `Password Token`='" . _SESSION['key'] . "'";
        $data = mysqli_fetch_array(mysqli_query($conn, $query));
        $conn->close();
        $_SESSION['FirstName'] = $data["First Name"];
        $_SESSION['LastName'] = $data["Last Name"];
        if (empty($data["Patient ID"])) { //Are we dealing with staff or a patient?
            $_SESSION['UID'] = $data["User ID"];
            $_SESSION['access'] = $data["" /* Whatever we call the rank in the database */];
        } else {
            $_SESSION['patient'] = $data["Patient ID"];
            $_SESSION['access'] = 1;
        }
    }
}
?>