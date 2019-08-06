<?php
require 'includes/session.inc';
// if we want to rename the page later, like landingpage.php or welcome.php
$URLAccessChange = "https://ccs.geekrunner.net/CCS/index.php";
// godMode 0 will turn off the ability to switch users
$godMode=1;

$accessUserGlobal = $_SESSION['access'];
// while testing user can set own access
if ( $godMode == 1 && $_GET['AUI'] ) {
	$accessUserLocal = $_GET['AUI'];
} else {
	$accessUserLocal = $accessUserGlobal;
}

// You can call a function multiple times. I'll call the global and local usernames.
function getUser($userName) {
	switch ( $userName ) {
		case 1:
			echo "patient";
			break;
		case 2:
			echo "doctor";
			break;
		case 3:
			echo "admin";
			break;
		case 4:
			echo "support";
			break;
	}
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
	<link href="https://fonts.googleapis.com/css?family=Heebo:300&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="css/baseStyle.css">
	<style type="text/css">
	<!--
	main form {
		padding:10px;
	}
	nav li {
		display:inline-block;
	}
	#selectGroup {
		width:200px;
		margin:0px auto 0px auto;
		background-color:#fafafa;
	}
	-->
	</style>
</head>
<body>
	<header>
	</header>
	<nav>
<?php
if ($godMode = 1) {
	echo "
	\t\t<ul>
	\n\t\t\t<li><a href='" . $URLAccessChange . "?AUI=1'>Patient</a></li>
	\n\t\t\t<li><a href='" . $URLAccessChange . "?AUI=2'>Doctor</a></li>
	\n\t\t\t<li><a href='" . $URLAccessChange . "?AUI=3'>Admin</a></li>
	\n\t\t\t<li><a href='" . $URLAccessChange . "?AUI=4'>Support</a></li>\n\t\t</ul>\n";
}
?>
	</nav>
	<main>
	<?php
		echo "Welcome ";
		getUser($accessUserGlobal);
		echo ". ";
		if ($godMode == 1 && $accessUserGlobal != $accessUserLocal) {
			echo "You are viewing this page as ";
			getUser($accessUserLocal);
		}
		echo "<br><br>";
		// This block grabs the modules that your access level allows
		if ( $accessUserLocal == 4 )
			{include 'includes/indexAccess4.inc';}
		if ( $accessUserLocal >= 3 && $accessUserLocal <= 4 )
			{include 'includes/indexAccess34.inc';}
		if ( $accessUserLocal == 3 )
			{include 'includes/indexAccess3.inc';}
		if ( $accessUserLocal >= 2 && $accessUserLocal <= 3 )
			{include 'includes/indexAccess23.inc';}
		if ( $accessUserLocal >= 1 && $accessUserLocal <= 4 )
			{include 'includes/indexAccess1234.inc';}
		if ( $accessUserLocal == 1 )
			{include 'includes/indexAccess1.inc';}
	?>
	</main>
	<footer>
	<form action="index.php" method="post">
		<input type="hidden" value="logout" name="logout" />
		<input class="button" type="submit" value="Logout" />
	</form>
	</footer>
</body>
</html>
