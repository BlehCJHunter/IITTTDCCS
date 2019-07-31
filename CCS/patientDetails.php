<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Clinical Coder v0.1</title>
<meta name="description" content="This website exists as a proof of concept for an Automated Clinical Coding System">
<meta name="keywords" content="clinical coding system, proof of concept">
<meta name="author" content="Brendan, Callum, Jess, Joe, Michael, Won">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="format-detection" content="telephone=no">
<link href="https://fonts.googleapis.com/css?family=Heebo:300&display=swap" rel="stylesheet"> 
<style type="text/css">
<!--
html, body		{margin:0 .7em; font-family: 'Heebo', sans-serif;}
header, footer	{text-align:center;}
header			{font-weight:bold; color:#444; background-color:#eee;}
main			{margin:3em auto 3em auto; background-color:#fff}
.barcode		{margin:5px; padding:9px 7px; font-size:0.7em; color:#fff; border:1px solid #007FFF; border-radius:6px; background-color:#007FFF;}
table			{max-width:960px; margin:3em auto 3em auto;}
td				{display:table-cell; padding-top: 0.65em;}
label			{font-size:0.65em; font-weight:bold; color:#666;}
.titleCell		{text-align:right}
.infoCell		{text-align:center; font-size:0.8em;}
.dataEntry		{padding-left:1.5em; line-height:1.6em;}
#extraInfo		{vertical-align:middle; padding-left:1em; line-height:1.6em; font-size:0.6em;}
textarea		{width:99%; height:75px;}
footer			{padding-right:10px; text-align:right;}
-->
</style>
</head>
<body>
	<header>
		Please Enter Patient Details
	</header>
<main>
	<table>
		<tr>
			<form action="somewhere.php" method="POST">
			<td class="titleCell"><label for="username">Patient Full Name:</label></td>
			<td colspan="2" class="dataEntry">
				<select name="patients">
					<option value="patient1">Jane Doe</option>
					<option value="patient2">John Deer</option>
					<option value="patient3">Jon Buck</option>
				</select>
			</td>
		</tr><tr>
			<td class="titleCell"><label for="uniqueID">Patient Unique ID:</label></td>
			<td class="dataEntry"><input class="field" name="uniqueID" type="text" min="2" max="25"></td>
			<td id="extraInfo">Please enter patient UR number, medicare number or other unique identifier.</td>
		</tr><tr>
			<td colspan="3" class="infoCell">Please confirm patient identified below is correct before proceeding.</td>
		</tr><tr>
			<td class="titleCell"><label for="ur">UR:</label></td>
			<td colspan="2" class="dataEntry"><input class="field" name="ur" type="text" min="2" max="25"></td>
		</tr><tr>
			<td class="titleCell"><label for="dateOfBirth">Date of Birth:</label></td>
			<td colspan="2" class="dataEntry"><input class="field" name="dateOfBirth" type="text" min="2" max="25"></td>
		</tr><tr>
			<td class="titleCell"><label for="address">Addresss:</label></td>
			<td colspan="2" class="dataEntry"><textarea></textarea></td>
		</tr><tr>
			<td colspan="3" class="infoCell">If a paper chart is available, you may scan the patient's UR barcode here:<br>
			<input class="barcode" type="button" value="Scan Patient Barcode"></td>
		</tr><tr>
			<td colspan="3" class="infoCell">
				<input class="resetButton" type="reset" value="Reset">
				<input class="confirmButton" name="login" type="submit" value="Confirm">
			</td>
		</form>
		</tr>
	</table>
</main>
	<footer>
		<form action="index.php" method="post">
			<input type="hidden" value="logout" name="logout" />
			<input class="button" type="submit" value="Logout">
		</form>
	</footer>
</body>
</html>