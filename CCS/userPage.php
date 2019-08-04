<?php
require 'includes/session.inc';
echo "";
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
	<?php //echo ""; include 'includes/nav.php';?>
	<main>
            <?php
            echo "";
            echo "Name: " . $_SESSION['FirstName'] . " " . $_SESSION['LastName'] . "<br>";
            echo "User ID: " . $_SESSION['UID'] . " " . "<br>";
            echo "Access Level: " . $_SESSION['access'] . "<br>";
            ?>
            	<form action="userPage.php" method="post">
		<input type="hidden" value="logout" name="logout" />
		<input class="button" type="submit" value="Logout" />
	</form>
	</main>
	<?php //echo ""; include 'includes/footer.php';?>
</body>
</html>