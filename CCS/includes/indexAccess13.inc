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
?><!--
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
</table> -->

<?php
/*
 * What we need:
 *  Table that contains Day, Month, Year, Time, User ID, patient ID
 *  This Calendar
 *  Working code
 *  Gah
 */
$offset = isset($_GET['offset']) ? $_GET['offset'] : 0;
// j means display day
$date = date_create();
switch ($offset <=> 0) {
    case 1:
        date_add($date, date_interval_create_from_date_string($offset . "months"));
        break;
    case -1:
        date_sub($date, date_interval_create_from_date_string((-$offset) . "months"));
        break;
}
require '../CCS/admin/includes/dbconnect.inc';
$query = "SELECT * FROM `testDates`";
$result = mysqli_query($conn, $query);
$conn->close();
$arr = array();
for ($i = 0; $i < mysqli_num_rows($result); $i++) {
    $s = mysqli_fetch_array($result);
    array_push($arr, $s['number']);
}
$daysInMonth = date("j", strtotime('last day of this month', date_timestamp_get($date)));
// N means display day of week as a number 1 to 7
$firstDayInMonth = date("N", strtotime('first day of this month', date_timestamp_get($date)));
//Set up the calendar
$month = date("F Y", date_timestamp_get($date));
?>
<table id="cal">
    <tr>
        <th id="calTitle" colspan = "7">
            <?php
            echo $month;
            ?>
        </th>
    </tr>
    <tr>
        <td class="calDayName">
            Sun
        </td>
        <td class="calDayName">
            Mon
        </td>
        <td class="calDayName">
            Tue
        </td>
        <td class="calDayName">
            Wed
        </td>
        <td class="calDayName">
            Thu
        </td>
        <td class="calDayName">
            Fri
        </td>
        <td class="calDayName">
            Sat
        </td>
    </tr>
    <?php
    echo "<tr>";
    // Grey dates pre-month
    for ($i = $firstDayInMonth; $i % 7 > 0; $i--) {
        echo "<td class=\"calDateCell\"></td>";
    }
    // Dates in this month
    for ($i = 1; $i <= $daysInMonth; $i++) {
        $s = "<a href=\"./appointments.php?date=" . date("dmY", mktime(0, 0, 0, date("m", date_timestamp_get($date)), $i, date("Y", date_timestamp_get($date)))) . "\">" . $i . "</a>";
        if ($i == date('d', time()) && $offset == 0) {
            echo "<td class=\"calDateCell\" style=\"background-color: #818100;\">" . $s . "</td>"; // Today
        } else if ($offset < 0 || ($i < date('d', time()) && $offset == 0)) {
            echo "<td class=\"calDateCell\" style=\"background-color: #408100;\">" . $s . "</td>"; // Previous dates
        } else {
            if (in_array($i, $arr)) {
                echo "<td class=\"calDateCell\" style=\"background-color: #8282d5;\">" . $s . "</td>"; // Marked dates
            } else {
                echo "<td class=\"calDateCell\">" . $s . "</td>"; // Ordinary dates
            }
        }
        echo "</a>";
        if (($i + $firstDayInMonth) % 7 == 0) {
            echo "</tr><tr>";
        }
    }
    // Grey dates post-month
    for ($i = $firstDayInMonth + $daysInMonth; $i % 7 > 0; $i++) {
        echo "<td class=\"calDateCell\"></td>";
    }
    echo "</tr>";
    ?>
    <tr>
        <td colspan="3">
            <form target="CallumsVeryYesGoodCalendar.php" method="GET" style="display: inline-block;">
                <input  value="<?php echo ($offset - 1); ?>" type="hidden" name="offset">
                <input  value="Last Month" type="submit">
            </form>
        </td>
        <td>

        </td>
        <td colspan="3">
            <form target="CallumsVeryYesGoodCalendar.php" method="GET">
                <input  value="<?php echo ($offset + 1); ?>" type="hidden" name="offset">
                <input value="Next Month" type="submit">
            </form>
        </td>
    </tr>
</table>

<br><br>