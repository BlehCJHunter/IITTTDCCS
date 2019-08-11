<?php

session_start();
if (!isset($_SESSION['timeout'])) {
    $_SESSION['timeout'] = date_create(); // Make our timout time
    $_SESSION['timeout'] = date_add($_SESSION['timeout'], date_interval_create_from_date_string("15 minutes")); // Make it 15 minutes from now
} elseif (date_timestamp_get(date_create()) > date_timestamp_get($_SESSION['timeout'])) { // If the time is after the session timout, destroy the session
    $_SESSION['active'] = 0;
} else { // If we don't timeout, reset the timer
    $_SESSION['timeout'] = date_create();
    $_SESSION['timeout'] = date_add($_SESSION['timeout'], date_interval_create_from_date_string("15 minutes")); 
}
if ($_POST["logout"] == "logout") {
    $_SESSION['active'] = 0;
}
if (!($_SESSION['active'] || isset($_SESSION['active'])) && !$_SESSION['loaded']) { // If the session is both inactive and unloaded, go to the login page
    header("Location: https://ccs.geekrunner.net/CCS/login.php");
    exit();
} else {
    if (!$_SESSION['loaded'] || !isset($_SESSION['loaded'])) { // If the session is not loaded, load it
        require 'admin/includes/dbconnect.inc';
        $query = "SELECT * FROM Users WHERE `Password Token`='" . $_SESSION['key'] . "'"; // Find the user associated with a given token
        $data = mysqli_fetch_array(mysqli_query($conn, $query));
        $conn->close();
        $_SESSION['FirstName'] = $data["First Name"]; // Now to load all the... Code Monkey Output :P
        $_SESSION['LastName'] = $data["Last Name"];
        if (empty($data["Patient ID"])) { //Are we dealing with staff or a patient?
            $_SESSION['UID'] = $data["User ID"];
            $_SESSION['access'] = $data["Access_ID"];
            $_SESSION['position'] = $data["" /* Whatever we call the position in the database, if we even track it */];
        } else {
            $_SESSION['patient'] = $data["Patient ID"];
            $_SESSION['access'] = 1;
            $_SESSION['position'] = "Patient";
        }
        $_SESSION['loaded'] = 1;
    } else if (!$_SESSION['active']) { // If the session is inactive, but loaded, unload it and go to the login page
        session_unset();
        session_destroy();
        header("Location: https://ccs.geekrunner.net/CCS/login.php");
        exit();
    }
}
?>