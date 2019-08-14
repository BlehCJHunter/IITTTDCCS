<?php
//require 'includes\session.inc';
//if ($_SESSION['access'] < 2){
//header("Location: index.php");
//}
require 'admin/includes/dbconnect.inc';
$query = "SELECT * FROM `Symptoms`";
$sympquer = mysqli_query($conn, $query);
$query = "SELECT * FROM `Procedure_Codes`";
$procquer = mysqli_query($conn, $query);
$conn->close();
$test = mysqli_fetch_row($sympquer);
mysqli_data_seek($sympquer, 0);
?>
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
            <?php echo $First_Name . " " . $Last_Name . " | UR: " . $ur . " | DOB: " . strtoupper(date_format(date_create($dateOfBirth), "dMY")); ?>
        </header>
        <main>
            <form action="codingSubmit.php" method="POST">
                <table>

                    <tr>

                        <td class="titleCell"><label for="assessmentDate">Date of assessment:</label></td>
                        <td class="dataEntry"><input class="field" name="assessmentDate" type="text" maxLength="25" value="<?php echo date_format(date_create(), "Y-m-d"); ?>"></td>
                    </tr><tr>
                        <td class="titleCell"><label for="diagnosis[]">Diagnosis:</label></td>
                        <td class="dataEntry">
                            <select multiple name="diagnosis[]">
                                <?php
                                while ($row = mysqli_fetch_row($sympquer)) {
                                    echo "<option value=\"" . $row[0] . "\">" . $row[1] . "</option>";
                                }
                                ?>
                            </select></td>
                        <td id="extraInfo">Control-click can let you select more than one procedure/diagnosis</td>
                    </tr><tr>
                        <td class="titleCell"><label for="procedure[]">Procedure:</label></td>
                        <td class="dataEntry">
                            <select multiple name="procedure[]">
                                <?php
                                while ($row = mysqli_fetch_row($procquer)) {
                                    echo "<option value=\"" . $row[0] . "\">" . $row[1] . "</option>";
                                }
                                ?>
                            </select></td>
                    </tr><tr>
                        <td class="titleCell"><label for="additional">Additional Materials:</label></td>
                        <td class="dataEntry"><textarea></textarea></td>
		</tr><tr>
			<td class="titleCell"><label for="status">Patient Status:</label></td>
			<td class="dataEntry">
				<select name="status">
					<option value="patient1">Alive</option>
					<option value="patient2">Injured</option>
					<option value="patient3">Call insurance!</option>
				</select>
			</td>
		</tr><tr>
			<td class="titleCell"><label for="address">Notes for clinical<br>coding team:</label></td>
			<td class="dataEntry"><textarea></textarea></td>
		</tr><tr>
			<td colspan="2" class="infoCell">
				<input class="resetButton" type="reset" value="Reset">
				<input class="confirmButton" name="login" type="submit" value="Confirm">
			</td>
		
		</tr>

	</table>
                </form>
</main>
	<footer>
		<form action="index.php" method="post">
			<input type="hidden" value="logout" name="logout" />
			<input class="button" type="submit" value="Logout">
		</form>
	</footer>
</body>
</html>