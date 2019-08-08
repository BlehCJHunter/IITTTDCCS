<?php
/*
if ( $accessUserGlobal == 1 ) {
	$CalBookedDates (
		array("2019-08-09","09:00","10:00","11:00","13:00","14:00","15:00"),
		array("2019-08-10","12:00","13:00","15:00","16:00"),
		array("2019-08-11","09:00","11:00","14:00","16:00"),
		array("2019-08-12","12:00"),
	);
} else if ( $accessUserGlobal == 3 ) {
	$calBookingsArray=array("Lain, T"=>"2019-08-07 12:30", "Gear, N"=>"2019-08-08 16:00", "Edwards, S"=>"2019-08-24");
} else {
	$message = "Please log in as a patient or admin.";
}
*/
?>
<table id="cal">
	<tr>
		<td id="calTitle" colspan="7">Availability Calendar</td>
	</tr><tr>
		<td class="calDayName">Sunday</td>
		<td class="calDayName">Monday</td>
		<td class="calDayName">Tuesday</td>
		<td class="calDayName">Wednesday</td>
		<td class="calDayName">Thursday</td>
		<td class="calDayName">Friday</td>
		<td class="calDayName">Saturday</td>
	</tr><tr>
		<td class="calDateCell">
			<table>
				<tr>
					<td class="cellDay" rowspan="2">1.</td>
					<td class="cellBookedName">
						<a href="test.html">Lain, T</a>
						<br><a href="test.html">Gear, N</a>
					</td>
				</tr>
			</table>
		</td>
		<td class="calDateCell">2</td>
		<td class="calDateCell">3</td>
		<td class="calDateCell">4</td>
		<td class="calDateCell">5</td>
		<td class="calDateCell">6</td>
		<td class="calDateCell">7</td>
	</tr><tr>
		<td class="calDateCell">8</td>
		<td class="calDateCell">9</td>
		<td class="calDateCell">10</td>
		<td class="calDateCell">11</td>
		<td class="calDateCell">12</td>
		<td class="calDateCell">13</td>
		<td class="calDateCell">14</td>
	</tr><tr>
		<td class="calDateCell">15</td>
		<td class="calDateCell">16</td>
		<td class="calDateCell">17</td>
		<td class="calDateCell">18</td>
		<td class="calDateCell">19</td>
		<td class="calDateCell">20</td>
		<td class="calDateCell">21</td>
	</tr><tr>
		<td class="calDateCell">22</td>
		<td class="calDateCell">23</td>
		<td class="calDateCell">24</td>
		<td class="calDateCell">25</td>
		<td class="calDateCell">26</td>
		<td class="calDateCell">27</td>
		<td class="calDateCell">28</td>
	</tr><tr>
		<td class="calDateCell">29</td>
		<td class="calDateCell">30</td>
		<td class="calDateCell">31</td>
		<td class="calEmptyCell">&nbsp;</td>
		<td class="calEmptyCell">&nbsp;</td>
		<td class="calEmptyCell">&nbsp;</td>
		<td class="calEmptyCell">&nbsp;</td>
	</tr><tr>
		<td id="calMessage" colspan="7">MOTD or alert goes here</td>
	</tr>
</table>
<br><br>