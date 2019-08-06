<?php
session_start();
session_destroy();
header("Location: https://ccs.geekrunner.net/CCS/login.php");
?>