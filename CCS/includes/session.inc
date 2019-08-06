<?php

session_start();
if (!isset($_SESSION['timeout'])) {
    $_SESSION['timeout'] = getdate();
    date_add($_SESSION['timeout'], date_interval_create_from_date_string("15 minutes"));
} elseif (time() > mktime($_SESSION['timeout'])) {
    $_SESSION['active'] = 0;
} else {
    $_SESSION['timeout'] = getdate();
    date_add($_SESSION['timeout'], date_interval_create_from_date_string("15 minutes"));
}
if ($_POST["logout"] == "logout") {
    $_SESSION['active'] = 0;
}
if (!$_SESSION['active'] && !$_SESSION['loaded']) {
    header("Location: https://ccs.geekrunner.net/CCS/login.php");
    exit();
} else {
    if (!$_SESSION['loaded'] || !isset($_SESSION['loaded'])) {
        require 'admin/includes/dbconnect.inc';
        $query = "SELECT * FROM Users WHERE `Password Token`='" . $_SESSION['key'] . "'";
        $data = mysqli_fetch_array(mysqli_query($conn, $query));
        $conn->close();
        $_SESSION['FirstName'] = $data["First Name"];
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
    } else if (!$_SESSION['active']) {
        session_unset();
        session_destroy();
        header("Location: https://ccs.geekrunner.net/CCS/login.php");
        exit();
    }
}
?>