<?php
session_start();
if ( $_POST["logout"] == "logout" ) {
	$_SESSION['active'] = "0";
}
if( @$_SESSION['active'] != "1" )
{
    header("Location: https://ccs.geekrunner.net/CCS/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Welcome to The Thing Doers Website</title>
        <meta name="description" content="This website exists as a proof of concept for an Automated Clinical Coding System">
        <meta name="keywords" content="clinical coding system, proof of concept">
        <meta name="author" content="Brendan, Callum, Jess, Joe, Michael, Won">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="format-detection" content="telephone=no">
	<link rel="stylesheet" href="css/baseStyle.css">
	<style type="text/css">
	<!--

	-->
	</style>
</head>
<body>
	<header>
	</header>
	<main>
	Empty Main Page<br>
	If you try to access this page without logging in first, it will redirect you to the login page.
	</main>
	<footer>
		<form action="index.php" method="post">
			<input type="hidden" value="logout" name="logout" />
			<input class="button" type="submit" value="Logout">
		</form>
	</footer>
</body>
</html>