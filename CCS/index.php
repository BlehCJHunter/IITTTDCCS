<?php
require 'includes/session.inc';
// godMode 0 will turn off the ability to switch users
$godMode=$_SESSION['dbg'];

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
// Chooses the start date for the doctors patient list
if ( $accessUserLocal == 2 ) {
	if ( $_GET['startDate'] ) {
		$startDate = $_GET['startDate'];
	} else {
		$startDate=date("Y-m-d");
	}
}
// if we want to rename the page later, like landingpage.php or welcome.php
$URLBuilderBase = "https://ccs.geekrunner.net/CCS/index.php?";
$URLBuilderHelp=$URLBuilderBase . "AUI=" . $accessUserLocal;
$URLBuilderAdvSearch=$URLBuilderBase . "AUI=" . $accessUserLocal;
$URLBuilderPaperArrows=$URLBuilderBase . "AUI=" . $accessUserLocal;
if ( accessUserLocal == 2 ){
	$URLBuilderHelp=$URLBuilderBase . "&startDate=" . $startDate;
	$URLBuilderAdvSearch=$URLBuilderBase . "&startDate=" . $startDate;
	$URLBuilderLocalAccess="&startDate=" . $startDate;
}
if ($_GET['help']=="yes"){
	$URLBuilderPaperArrows=$URLBuilderBase . "&help=yes";
	$URLBuilderAdvSearch=$URLBuilderBase . "&help=yes";
	$URLBuilderLocalAccess=$URLBuilderLocalAccess . "&help=yes";
}
if ($_GET['advSearch']){
	$URLBuilderPaperArrows=$URLBuilderBase . "&advSearch=on";
	$URLBuilderHelp=$URLBuilderBase . "&advSearch=on";
	$URLBuilderLocalAccess=$URLBuilderLocalAccess . "&advSearch=on";
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
	<?php if ($godMode == 1) {echo "<link rel='stylesheet' href='css/godModeStyle.css'>";}?>
	<?php if ($accessUserLocal == 2) {echo "<link rel='stylesheet' href='css/patientTableStyle.css'>";}?>

	<style type="text/css">
	<!--
	body {
		margin:0;
	}
	nav, main, footer {
		margin:0 auto;
		max-width:960px;
	}
	h1, h2 {
		margin:0;
		font-size:1em;
		font-weight:bold;
	}
	header h1 {
		color:#444;
	}
	#mainMenu {
		line-height:35px;
	}
	#mainMenu ul {
		margin:0; text-align:right;
	}
	#mainMenu li {
		display:inline-block; margin-right:15px;
	}
	small, #godMenu a {
		color:red;
		text-align:center;
	}
	#welcome {
		margin:20px 15px 20px 15px;
		text-align:right;
	}
	#welcome h2 {
		text-transform:capitalize;
	}
	#cal, #sendForm, .modifyUsers {
		margin-left:auto;
		margin-right:auto;
		background-color:#fafafa;
		border:1px solid #bbb;
		border-radius:15px;
	}
	#calTitle {
		text-align:center;
		font-size:1.2em;
	}
	.calDayName {
		text-align:center;
		font-weight:bold;
	}
	.calEmptyCell {
		background-color:#f0f0f0;
	}
	.calDateCell {
		background-color:#fff;
	}
	.calDateCell, .calEmptyCell {
		border:1px solid #bbb;
	}
	#calMessage {
		text-align:center;
		font-size:0.8em;
	}
	.cellDay {
		padding:3px 0 0 3px;
		vertical-align:top;
	}
	.cellBookedTime, .cellBookedName {
		padding:2px;
	}
	#sendForm {
		display:table;
		padding:1em;
	}
	.alert {
		color:red;
		text-align:center;
	}
	.centeredSubmit {
		text-align:center;
	}
	.leftColumn {
		text-align:right;
	}
	.modifyUsers{
		margin:0 auto;
		padding:1em;
	}
	#formCheckDel {
		color:red;
	}
	-->
	</style>
</head>
<body>
	<nav>
<?php
if ($godMode == 1) {
	echo "\t\t<small>&nbsp;testing enabled</small><br>
	\t\t<ul id='godMenu'>
	\n\t\t\t<li><a href='" . $URLBuilderBase . "AUI=1" . $URLBuilderLocalAccess . "'>Patient</a></li>
	\n\t\t\t<li><a href='" . $URLBuilderBase . "AUI=2" . $URLBuilderLocalAccess . "'>Doctor</a></li>
	\n\t\t\t<li><a href='" . $URLBuilderBase . "AUI=3" . $URLBuilderLocalAccess . "'>Admin</a></li>
	\n\t\t\t<li><a href='" . $URLBuilderBase . "AUI=4" . $URLBuilderLocalAccess . "'>Support</a></li>\n\t\t</ul>\n";
}
?>
	</nav>
	<header>
		<h1>Clinical Coder v0.1</h1>
	</header>
	<nav id='mainMenu'>
		<ul>
			<li><a href='<?php echo $URLBuilderHelp; if ( $_GET['help'] ) {}else {echo "&help=yes";} ?>'>Help</a></li>
			<li><form action="index.php" method="post"><input type="hidden" value="logout" name="logout" /><input class="button" type="submit" value="Logout" /></form></li>
		</ul>
	</nav>
	<main>
	<?php
		echo "<section id='welcome'><h2>Welcome ";
		getUser($accessUserGlobal);
		echo "</h2> ";
		$x=0;
		// Statement below will show you your level of access
		if ($godMode == 1 && $accessUserGlobal != $accessUserLocal) {
			echo "You are viewing this page as ";
			getUser($accessUserLocal);
			$x=1;
		}
		echo "</section>";
		// This block grabs the modules that your access level allows
		// If you request help
		if ( $_GET['help'] == "yes" )
			{include 'includes/indexAccess1234.inc';}
		// Doctor and edit patient info forms
		if ( $accessUserLocal == 2 )
			{include 'includes/indexAccess2.inc';}
		// Booking calendar
		if ( $accessUserLocal == 1 OR $accessUserLocal == 3 )
			{include 'includes/indexAccess13.inc';}
		// admin patient accounts
		if ( $accessUserLocal >= 3 && $accessUserLocal <= 4 )
			{include 'includes/indexAccess34.inc';}
		// admin all accounts
		if ( $accessUserLocal == 4 )
			{include 'includes/indexAccess4.inc';}
		// patient advanced search
		if ( $accessUserLocal == 2 OR $accessUserLocal == 3 )
			{include 'includes/indexAccess23.inc';}
		// view and send doctors forms and create entries to the calendar
		if ( $accessUserLocal == 3 )
			{include 'includes/indexAccess3.inc';}
	?>
	</main>
	<footer>
	</footer>
</body>
</html>