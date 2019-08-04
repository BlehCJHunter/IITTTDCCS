<?php
require 'includes/session.inc';
if( $_SESSION['active'] && $_SESSION['loaded'])
{
    header("Location: https://ccs.geekrunner.net/CCS/userPage.php");
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
<?php
$accessID = $_SESSION['access'];
echo "";
if ( isset($accessID) ) {
	echo "Access ID has been set.";
}else{
	echo 'Access ID has not been set.<br>Please select a user type:';
	echo '<form action="index.php" method="post">\n\t<label>Select a group:</label>\n';
	echo '\t<input type="radio" name="Support" id="support" value="4" /><label for="support">Support</label>\n';
	echo '\t<input type="radio" name="Admin" id="admin" value="3" /><label for="admin">Administrator</label>\n';
	echo '\t<input type="radio" name="Doctor" id="doctor" value="2" /><label for="doctor">Doctor</label>\n';
	echo '\t<input type="radio" name="Patient" id="patient" value="1" /><label for="patient">Patient</label>\n';
	echo '\t<input class="button" type="submit" value="Go" />';
	echo '</form>';
}
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