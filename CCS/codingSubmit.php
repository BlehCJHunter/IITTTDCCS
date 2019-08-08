<?php
require 'includes\session.inc';
if ($_SESSION['access'] < 2){
    header("Location: index.php");
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
	<?php include 'includes/nav.php';?>
	<main>
	</main>
	<?php include 'includes/footer.php';?>
</body>
</html>