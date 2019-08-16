<?php
require 'includes/session.inc';
// godMode 0 will turn off the ability to switch users
$godMode=$_SESSION['dbg'];
if (isset($_GET['errorstate'])){
    echo "Error: ";
    switch ($_GET['errorstate']){
        case "failupdate":
            echo "No such user/patient when attempting to update<br>";
            break;
        
        default :
            echo "Unknown Error<br>";
            break;
    }
}

// Holds a variable on the level of access a user has on the page
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
if ( $accessUserLocal == 3 ) {
	if ( $_GET['appointmentCal'] ) {
		$appointmentCal = $_GET['appointmentCal'];
		$appointmentCal = explode("-", $appointmentCal);
		$adminCalYear = $appointmentCal[0];
		$adminCalMonth = $appointmentCal[1];
		$adminCalDay = $appointmentCal[2];
	} else {
		$adminCalYear=date('Y');
		$adminCalMonth=date('m');
		$adminCalDay=date('d');
	}
	$adminCalDate=$adminCalYear . "-" . $adminCalMonth . "-" . $adminCalDay;
}
// if we want to rename the page later, like landingpage.php or welcome.php
$linkHelp=$_GET['help'];
$linkAdvSearch=$_GET['advSearch'];
$linkComplaint=$_GET['complaint'];

$URLBuilderBase = "https://ccs.geekrunner.net/CCS/index.php?";
$URLBuilderHelp = $URLBuilderBase . "AUI=" . $accessUserLocal;
$URLBuilderComplaint = $URLBuilderBase . "AUI=" . $accessUserLocal;
$URLBuilderPaperArrows = $URLBuilderBase . "AUI=" . $accessUserLocal;
$URLBuilderAdvSearch = $URLBuilderBase . "AUI=" . $accessUserLocal;
$URLBuilderAdminCalDate = $URLBuilderBase . "AUI=" . $accessUserLocal;

if ( $accessUserLocal == 2 ){
	$URLBuilderLocalAccess="&startDate=" . $startDate;
	$URLBuilderComplaint=$URLBuilderComplaint . "&startDate=" . $startDate;
	$URLBuilderHelp=$URLBuilderHelp . "&startDate=" . $startDate;
	$URLBuilderPaperArrows=$URLBuilderPaperArrows . "&startDate=" . $startDate;
	$URLBuilderAdvSearch=$URLBuilderAdvSearch . "&startDate=" . $startDate;
}
if ( $accessUserLocal == 3 ){
	$URLBuilderLocalAccess="&adminCalDate=" . $adminCalDate;
	$URLBuilderComplaint=$URLBuilderComplaint . "&adminCalDate=" . $adminCalDate;
	$URLBuilderHelp=$URLBuilderHelp . "&adminCalDate=" . $adminCalDate;
	$URLBuilderAdvSearch=$URLBuilderAdvSearch . "&adminCalDate=" . $adminCalDate;
}
if ($linkAdvSearch=="on" && $accessUserLocal == 2 || $accessUserLocal == 4){
	$URLBuilderLocalAccess=$URLBuilderLocalAccess . "&advSearch=on";
	$URLBuilderComplaint=$URLBuilderComplaint . "&advSearch=on";
	$URLBuilderHelp=$URLBuilderHelp . "&advSearch=on";
	$URLBuilderPaperArrows=$URLBuilderPaperArrows . "&advSearch=on";
	$URLBuilderAdminCalDate=$URLBuilderAdminCalDate . "&advSearch=on";
}
if ($linkHelp=="yes"){
	$URLBuilderLocalAccess=$URLBuilderLocalAccess . "&help=yes";
	$URLBuilderComplaint=$URLBuilderComplaint . "&help=yes";
	$URLBuilderPaperArrows=$URLBuilderPaperArrows . "&help=yes";
	$URLBuilderAdvSearch=$URLBuilderAdvSearch . "&help=yes";
	$URLBuilderAdminCalDate=$URLBuilderAdminCalDate . "&help=yes";
}
if ($linkComplaint == 1 && $linkHelp =="yes"){
	$URLBuilderLocalAccess=$URLBuilderLocalAccess . "&complaint=1";
	$URLBuilderHelp=$URLBuilderHelp . "&complaint=1";
	$URLBuilderPaperArrows=$URLBuilderPaperArrows . "&complaint=1";
	$URLBuilderAdvSearch=$URLBuilderAdvSearch . "&complaint=1";
	$URLBuilderAdminCalDate=$URLBuilderAdminCalDate . "&complaint=1";
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
	#bookingCalendar {
		width:100%;
		padding:.5em;
	}
	#monthName {
		text-align:center;
		font-weight:normal;
		font-size:2em;
	}
	.dayNames {
		text-transform:capitalize;
	}
	#cal, #sendForm, .modifyUsers, #auditForm, #help, .centeredTheme {
		margin-left:auto;
		margin-right:auto;
		max-width:960px;
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
	.calColorCell1 {
		background-color:#e9e9e9;
	}
	.calColorCell2 {
		background-color:#e0e0e0;
	}
	.calColorCell3 {
		background-color:#e0e0e0;
	}
	.calDateCell {
		background-color:#fff;
	}
	.calDateCell, .calEmptyCell, .calColorCell1, .calColorCell2, .calColorCell3 {
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
	#bookingCalendar td {
		vertical-align:top;
	}
	#bookingCalendar th {
		width:14%;
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
	#help {
		max-width:515px;
		padding:2em;
	}
	#helpTextArea {
		width:90%;
		height:150px;
		margin-top:1em;
	}
	#machineAccessTable {
		margin:0 auto;
	}
	#machineAccessTable td{
		padding:.2em .5em;
	}
	#advSearch {
		max-width:350px;
		padding:.5em;
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
