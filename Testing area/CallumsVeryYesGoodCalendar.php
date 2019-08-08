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
for ($i = 0; $i < mysqli_num_rows($result); $i++){
    $s = mysqli_fetch_array($result);
    array_push($arr, $s['number']);
}
$daysInMonth = date("j", strtotime('last day of this month', date_timestamp_get($date)));
// N means display day of week as a number 1 to 7
$firstDayInMonth = date("N", strtotime('first day of this month', date_timestamp_get($date)));
//Set up the calendar
$month = date("F Y", date_timestamp_get($date));
?>
<style>
    table .no {
        background-color: #28343b;
        padding: 5px 10px;
    }
    table .head {
        background-color: #993300;
        padding: 5px 10px;
        text-align: center;
    }
    table td {
        background-color: #828282;
        padding: 5px 10px;
        text-align: center;
    }
</style>
<table>
    <tr>
        <th class = "head" colspan = "7">
            <?php
            echo $month;
            ?>
        </th>
    </tr>
    <tr>
        <td class = "head">
            Sun
        </td>
        <td class = "head">
            Mon
        </td>
        <td class = "head">
            Tue
        </td>
        <td class = "head">
            Wed
        </td>
        <td class = "head">
            Thu
        </td>
        <td class = "head">
            Fri
        </td>
        <td class = "head">
            Sat
        </td>
    </tr>
    <?php
    echo "<tr>";
    // Grey dates pre-month
    for ($i = $firstDayInMonth; $i % 7 > 0; $i--) {
        echo "<td class=\"no\"></td>";
    }
    // Dates in this month
    for ($i = 1; $i <= $daysInMonth; $i++) {
        $s = "<a href=\"./appointments.php?date=" . date("dmY", mktime(0, 0, 0, date("m", date_timestamp_get($date)), $i, date("Y", date_timestamp_get($date)))) . "\">" . $i . "</a>";
        if ($i == date('d', time()) && $offset == 0) {
            echo "<td style=\"background-color: #818100;\">" . $s . "</td>"; // Today
        } else if ($offset < 0 || ($i < date('d', time()) && $offset == 0)) {
            echo "<td style=\"background-color: #408100;\">" . $s . "</td>"; // Previous dates
        } else {
            if (in_array($i, $arr)) {
                echo "<td style=\"background-color: #8282d5;\">" . $s . "</td>"; // Marked dates
            } else {
                echo "<td>" . $s . "</td>"; // Ordinary dates
            }
        }
        echo "</a>";
        if (($i + $firstDayInMonth) % 7 == 0) {
            echo "</tr><tr>";
        }
    }
    // Grey dates post-month
    for ($i = $firstDayInMonth + $daysInMonth; $i % 7 > 0; $i++) {
        echo "<td class=\"no\"></td>";
    }
    echo "</tr>";
    ?>
</table>
<form target="CallumsVeryYesGoodCalendar.php" method="GET" style="display: inline-block;">
    <input  value="<?php echo ($offset - 1); ?>" type="hidden" name="offset">
    <input  value="Last Month" type="submit">
</form>
<form target="CallumsVeryYesGoodCalendar.php" method="GET">
    <input  value="<?php echo ($offset + 1); ?>" type="hidden" name="offset">
    <input value="Next Month" type="submit">
</form>