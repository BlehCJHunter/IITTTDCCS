<div class='centeredTheme' id='advSearch'>
<div style='text-align:center;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style="margin-right:50px;" href='<?php echo $URLBuilderAdvSearch; if ( $linkAdvSearch ) {}else {echo "&advSearch=on";} ?>'>Advanced Search</a></div>
<?php
// If advanced search has been selected
if( $_GET['advSearch'] == "on") {
	echo "<div class='alert' style='text-align:center'>Work in progress - Not working</div><br>
	<form action='index.php' method='get'>
		Search by last name:<br>
		<input type='text' name='lastname'><br><br>
		Search by phone number:<br>
		<input type='' name='phone'><br><br>
		Search by phone number:<br>
		<input type='' name='phone'><br><br>
		<input type='submit' value='Submit'>
	</form>";
}
?>
</div>
<br><br>