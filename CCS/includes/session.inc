<?php
session_start();
if( @$_SESSION['active'] != "1" )
{
    header("Location: https://ccs.geekrunner.net/CCS/login.php");
    exit();
}
?>