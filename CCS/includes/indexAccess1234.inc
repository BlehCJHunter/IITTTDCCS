<div id='help'>
	<button onclick='patientEmergency()'>Call a nurse</button> (emergency only)<br>
	<button onclick='staffRequest()'>Ask for staff</button><br>
	<a href='<?php echo $URLBuilderComplaint; if ( $_GET['complaint'] ) {}else {echo "&complaint=1";} ?>'>Report a problem with the website</a>
	<?php
	if ( $_GET['complaint'] ) {
		echo "<br><div class='centeredSubmit'>\n\t<form>\n\t\t<textarea id='helpTextArea'>Please explain in as much detail as possible.</textarea><br>\n\t\t<input type='checkbox'>May we contact you?<br>\n\t\t<input type='submit'>\n\t</form>\n</div>";
	}
	?>
	<script>
	function patientEmergency() {
		alert('Support staff is on their way.');
	}
	function staffRequest() {
		alert('The current wait time is 7-9 minutes. Someone will be there soon.');	
	}
	</script>
</div>
<br><br>
