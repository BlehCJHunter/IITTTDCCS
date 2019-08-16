<div class='centeredTheme'>
<?php
require 'admin/includes/dbconnect.inc';

$sqlStartDate = date("Y-m-d 00:00:00",strtotime('first day of this month', $adminCalDate));
$sqlEndDate = date("Y-m-d 23:59:59",strtotime('last day of this month', $adminCalDate));

$sql = 'SELECT `Patient_Details`.`Last Name`, `Patient_Details`.`First Name`, `Case_Master`.`Admission Date/Time` FROM `Case_Master` INNER JOIN `Patient_Details` ON `Case_Master`.`Patient ID` = `Patient_Details`.`Patient ID` WHERE ( `Case_Master`.`Admission DATE/TIME` BETWEEN "$sqlStartDate" AND "2020-12-12" ) ORDER BY `Admission DATE/TIME` ASC';
$result=mysqli_query($conn,$sql);
$appointmentArray=array();
$fullArray=array();
$x=0;
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

echo "<table id='bookingCalendar'>\n\t<form>\n\t<tr>\n\t\t<th colspan='7' id='monthName'>";
echo "<a href='" . $URLBuilderAdminCalDate . "&appointmentCal=" . date("Y-m-d", strtotime($adminCalDate . "-1 month")) . "'><<</a>&nbsp;&nbsp;&nbsp;" . date('F', strtotime($adminCalDate)) . "&nbsp;&nbsp;&nbsp;<a href='" . $URLBuilderAdminCalDate . "&appointmentCal=" . date("Y-m-d", strtotime($adminCalDate . "+1 month")) . "'>>></a>";
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
	echo "\t\t<td class='calDateCell'>" . $numberDay;
	echo "<div style='padding:.3em'>";
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
echo "<form>
	Add Patient <input type='text'> Date <input type='text'> Time <input type='text'> <input type='submit'>
</form>";
echo "</td>\n\t</form>\n</table>";
?>
</div>
<br><br>