<?php
// If advanced search has been selected
if( $_GET['advSearch'] == "on") {
	echo "<form action='index.php' method='get'>
		Search by last name:<br>
		<input type='text' name='lastname'><br><br>
		Search by phone number:<br>
		<input type='' name='phone'><br><br>
		Search by phone number:<br>
		<input type='' name='phone'><br><br>
		<input type='submit' value='Submit'>
	</form>";
}