<!DOCTYPE html>
<html>
	<head>
		<title>
			Assignment 1 Webpage Index
		</title>
        <script language="javascript" src="./calendar/calendar.js"></script>
	</head>
    <body>
    The date you selected was <?php 
    $theDate = mktime(0, 0, 0, isset($_REQUEST["date1_month"]) ? $_REQUEST["date1_month"] : 0, isset($_REQUEST["date1_day"]) ? $_REQUEST["date1_day"] : 0, isset($_REQUEST["date1_year"]) ? $_REQUEST["date1_year"] : 0);
    echo date("d/m/Y", $theDate);
    ?>
    </body>
</html>