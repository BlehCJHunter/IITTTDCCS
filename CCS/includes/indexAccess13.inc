<div class='centeredTheme'>
<?php
require 'admin/includes/dbconnect.inc';

// Set calendar appointment
if ( isset($_GET['patientID']) ) {
	$sql10=' SELECT `Case ID` FROM `Case_Master` ';
	$result10=mysqli_query($conn,$sql10);
	$caseID=mysqli_num_rows($result10)+1;
	$patientID = $_GET['patientID'];
	$admissionDateTime=$_GET['adminCalDate'] . " " . $_GET['adminCalTime'];
	// Discharge Date/Time (try not to add)
	$sql11=" INSERT INTO Case_Master (`Case ID`, `Patient ID`, `User ID Submitted`, `Admission Date/Time`) VALUES ('$caseID', '$patientID', '$accessUserLocal', '$admissionDateTime') ";
	if ($conn->query($sql11) === TRUE) {
		echo "Patient has been entered.";
	}else{
		echo "Patient couldn't be entered.";
	}
	$sql12=" INSERT INTO Procedure_Case_User (`Procedure_ID`, `Procedure Code ID`, `Case ID`, `User ID`, `Patient ID`, `Procedure Date/Time`) VALUES ('$caseID', '1' , '$caseID', '$accessUserLocal', '$patientID', '$admissionDateTime') ";
	if ($conn->query($sql12) === TRUE) {
		echo "<br>Procedure Case has been entered.";
	}else{
		echo "<br>Procedure Case couldn't be entered.";
	}
}

$sqlStartDate = date("Y-m-d 00:00:00",strtotime('first day of this month', $adminCalDate));
$sqlEndDate = date("Y-m-d 23:59:59",strtotime('last day of this month', $adminCalDate));

$sql = 'SELECT `Patient_Details`.`Last Name`, `Patient_Details`.`First Name`, `Case_Master`.`Admission Date/Time` FROM `Case_Master` INNER JOIN `Patient_Details` ON `Case_Master`.`Patient ID` = `Patient_Details`.`Patient ID` WHERE ( `Case_Master`.`Admission DATE/TIME` BETWEEN "$sqlStartDate" AND "2020-12-12" ) ORDER BY `Admission DATE/TIME` ASC';
$sql2='SELECT `Patient ID`, `Last Name` FROM `Patient_Details`';

$result=mysqli_query($conn,$sql);
$result2=mysqli_query($conn,$sql2);

$appointmentArray=array();
$fullArray=array();
$x=0;
$patientNameList=array();
while($row = mysqli_fetch_assoc($result)){
	array_push($appointmentArray, strtok($row['Admission Date/Time'],' '));
	array_push($fullArray, $row);
	$x++;
}
$totalDays=cal_days_in_month(CAL_GREGORIAN,$adminCalMonth,$adminCalYear);
$firstDay=date("N", strtotime("$adminCalYear-$adminCalMonth-01"));
$lastDay=date("N", strtotime("$adminCalYear-$adminCalMonth-$totalDays"));
$dayOfWeek=array("sun","mon","tue","wed","thu","fri","sat");
$dayOfWeekCounter=0;

echo "<table id='bookingCalendar'>\n\t<form>\n\t<tr>\n\t\t<th colspan='7'>";
if($accessUserLocal==1){echo "<div class='alert' style='text-align:center'>Work in progress - Not working</div>";}
echo "<a href='" . $URLBuilderAdminCalDate . "&appointmentCal=" . date("Y-m-d", strtotime($adminCalDate . "-1 month")) . "'><<</a>&nbsp;&nbsp;&nbsp;<span id='monthName'>"; if($accessUserLocal==3){echo date('F Y', strtotime($adminCalDate));}else{echo "August 2019";} echo "</span>&nbsp;&nbsp;&nbsp;<a href='" . $URLBuilderAdminCalDate . "&appointmentCal=" . date("Y-m-d", strtotime($adminCalDate . "+1 month")) . "'>>></a>";
echo "</th>\n\t</tr><tr>\n";
for ( $x = 0; $x <= 6; $x++ ) {
	echo "\t\t<th class='dayNames'>" . $dayOfWeek[$x] . "</th>\n";
}
echo "\t</tr><tr>\n";
if( $firstDay != 7 ) {
	for ( $x = 0; $x < $firstDay; $x++ ) {
		echo "\t\t<td class='calEmptyCell'>&nbsp;</td>\n";
		$dayOfWeekCounter++;
	}
}

$x=0;
while ( $dayOfWeekCounter < 7 AND $x < $totalDays ) {
	$numberDay=$x+1;
	echo "\t\t<td class='calDateCell'><a href='" . $URLBuilderAdminCalDate . "&appointmentCal=" . $adminCalYear . "-" . $adminCalMonth . "-" . $numberDay . "'>" . $numberDay;
	echo "</a>\n<div style='padding:.3em'>";
	foreach($fullArray as $data) {
		$temp=$data['Admission Date/Time'];
		$temp2=$data['Last Name'];
		$temp3=$data['First Name'];
		$calTestDay = $adminCalYear . "-" . $adminCalMonth . "-" . $numberDay;
		$dateOnlyTemp = explode(" ", $temp);
		$dateOnly=$dateOnlyTemp[0];
		if ($dateOnly == $calTestDay) {
		echo $temp2 . ", " . $temp3 . " - " . $dateOnlyTemp[1] . "<br>";
		}
	}
	echo "</div>";
	echo "</td>\n";
	$dayOfWeekCounter++;
	if($dayOfWeekCounter == 7) {
		echo "\t</tr><tr>\n";
		$dayOfWeekCounter=0;
	}
	$x++;
}
if ($dayOfWeekCounter != 7 AND $dayOfWeekCounter != 0) {
	while($dayOfWeekCounter < 7) {
		echo "\t\t<td class='calEmptyCell'>&nbsp;</td>\n";
		$dayOfWeekCounter++;
	}
}
$dayOfWeekCounter=0;
echo "\t</tr><tr>\n\t\t<td colspan='7' style='text-align:center;padding:.5em'>";
echo "<form action='index.php' method='get'>
	Add Patient <select name='patientID'>";
while ($pList = mysqli_fetch_row($result2)) {
        echo "\t<option value='";
	echo $pList[0];
	echo "'>";
	echo $pList[1];
	echo "</option>\n";
}
echo "</select>Date <input type='text' name='adminCalDate' value='" . $adminCalDate . "'> 
	Time <select name='adminCalTime'>
		<option value='8:00:00'>8:00</option>
		<option value='8:30:00'>8:30</option>
		<option value='9:00:00'>9:00</option>
		<option value='9:30:00'>9:30</option>
		<option value='10:00:00'>10:00</option>
		<option value='10:30:00'>10:30</option>
		<option value='11:00:00'>11:00</option>
		<option value='11:30:00'>11:30</option>
		<option value='12:00:00'>12:00</option>
		<option value='12:30:00'>12:30</option>
		<option value='13:00:00'>13:00</option>
		<option value='13:30:00'>13:30</option>
		<option value='14:00:00'>14:00</option>
		<option value='14:30:00'>14:30</option>
		<option value='15:00:00'>15:00</option>
		<option value='15:30:00'>15:30</option>
		<option value='16:00:00'>16:00</option>
		<option value='16:30:00'>16:30</option>
	</select>
	<input type='hidden' name='AUI' value='3'>
	<input type='submit' value='Add to Calendar'>
</form>";
echo "</td>\n\t</form>\n</table>";
?>
</div>
<br><br>