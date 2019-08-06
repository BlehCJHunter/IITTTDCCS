<?php
if (isset($_GET["days"])){
	$display=$_GET["days"];

	$DBServer = 'localhost';
	$DBUser = 'c1_ccs';
	$DBPass = 'TTD123!!!';
	$DBName = 'c1_ccs';
	$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$query = mysqli_query($conn, "SELECT * FROM testDates WHERE number =$display");
	$rows = mysqli_num_rows($query);
	if ($rows == 1) {
		// if there is a row found, delete it.
		$sql = "DELETE FROM testDates WHERE number=$display";
		if ($conn->query($sql) === TRUE) {
		    $message = "Record updated successfully";
		} else {
		    $message = "sorry, something horrible happened. turn around slowly...";
		}
		mysqli_close($conn);
	}else{
		// if there are no rows returned, then add a row to the database
		$sql = "INSERT INTO testDates (number) VALUES ('$display')";
		if ($conn->query($sql) === TRUE) {
		    $message = "Record updated successfully";
		} else {
		    $message = "sorry, something horrible happened. turn around slowly...";
		}
		mysqli_close($conn);
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Test Area for Joe</title>
</head>
<body>
<!-- This is a simple PHP calendar for this month. -->
<?php
// j means display day
$daysInMonth = date("j",strtotime('last day of this month', time()));
// N means display day of week as a number 1 to 7
$firstDayInMonth = date("N",strtotime('first day of this month', time()));
$x=0;
$w=0;
// \n stands for new line and \t stands for tab in HTML.
echo "<table>\n\t<tr>";
// For every day before the first of the month, add empty cells.
do {
	echo "\t\t<td></td>\n";
	$x++;
	$w++;
	$firstDayInMonth--;
} while ($firstDayInMonth > 1);
// For every day of the month, add a number starting with 1 at an increments of 1 until the last day of the month.
    while($x <= $daysInMonth) {
        echo "\t\t<td";
        $DBServer = "localhost";
        $DBUser = "c1_ccs";
        $DBPass = "TTD123!!!";
        $DBName = "c1_ccs";
        $conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $query = "SELECT number FROM testDates";
        $result=mysqliquery($conn,$query);
        echo "<pre>";
        print_r($result);
        echo "</pre><br><br>";
        
        $rowTotal=mysqli_num_rows($result);
        echo $rowTotal . "<br><br>";
        
        $rawArray=mysqli_fetch_all($result,MYSQLI_NUM);
        echo "<pre>";
        print_r($rawArray);
        echo "</pre><br><br>";
        
        $dateArray=array();
        $i=0;
        while($i <$rowtotal){
            array_push($datearray,$rawArray[$i][0]);
            $i++;
        }
        
        echo "<pre";
        print_r($dateArray);
        echo "</pre><br><br>";
        
        mysqli_free_result($result);
        mysqli_close($conn);
        if (in_array("$dateArray", $rows)) {
            echo ' style="background-color:yellow;"';
        }
        echo ">" . $x . "</td>\n";
        $w++;
        // every 7 days, start a new week
        if($w == 7) {
            echo "\t</tr><tr>\n";
            $w = 0;
        }
        $x++;
    }
    echo "\t</tr>\n</table>";
    ?>
<!-- End of Calendar -->

<br><br>Highlight a day:
<form action="testForJoe.php" method="GET">
	<select name="days">
		<?php
		$x=1;
		while ($x <= $daysInMonth) {
			echo "\t<option value=" . $x;
			if(isset($display) && $display == $x){
				echo ' selected="' . $x . '"';
			}
			echo ">" . $x . "</option>\n";
			$x++;
		}
		?>
	</select>
	<input type="submit">
</form>
<br>
<?php
if (isset($display)) {
	echo "You decided to flip the switch on " . $display . ". Good Choice.<br>";
}
if(isset($message)) {
	echo $message;
}
?>
</body>
</html>
