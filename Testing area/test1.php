<!DOCTYPE html>
<html>
	<head>
		<title>
			Assignment 1 Webpage Index
		</title>
        <script language="javascript" src="./calendar/calendar.js"></script>
	</head>
	<body>
    <!-- 
    Calendar code from http://www.triconsole.com/php/calendar_datepicker.php
    Used as the code creator has allowed within their copyright, from the page:
    Copyright
    This calendar datepicker is totally free to use. You can use it in all of your projects without any costs. 
    -->
      <form action="test.php" method="post">
<?php
//get class into the page
require_once('calendar/tc_calendar.php');

//instantiate class and set properties
	  $myCalendar = new tc_calendar("date1", true);
	  $myCalendar->setIcon("calendar/images/iconCalendar.gif");
	  $myCalendar->setPath("calendar/");
      $myCalendar->setDate(date("d"), date("m"), date("Y"));
	  $myCalendar->setYearInterval(1960, date("Y"));
	  $myCalendar->dateAllow('1900-01-01', date("Y-m-d"));
	  $myCalendar->writeScript();
?>
<input type="submit">
</form>
	</body>
</html>
