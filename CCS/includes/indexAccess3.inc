<div id='sendForm'>
	<div class='alert' style='text-align:center;'>Work in progress - Not working</div>
	<h3 style='text-align:center; margin-top:0;'>Send batch of forms to government</h3>
	<form action='index.php' method='get'>
		Send in time period:
		<select name='timePeriod'>
			<option value='2019-11-06'>June 1st - June 30th, 2019</option>
			<option value='2019-11-07'>July 1st - July 31st, 2019</option>
			<option value='2019-11-08'>August 1st - August 31st, 2019</option>
		</select><br><br>
		<div class='alert'>Status: Not completed<br>Dr. Alan, J. hasn't closed patient form #43766</div><br>
		On duty floor manager's code:
		<input type='password' name='managerCode'><br><br>
		Sender's name:<br>
		<?php echo $_SESSION['FirstName'] . " " . $_SESSION['LastName']; ?><br><br>
		Terms of service: <input type='checkbox' name='terms'><br><br>
		<div  class='centeredSubmit'><input type='submit' value='Send'></div>
	</form>
</div>
<br><br>