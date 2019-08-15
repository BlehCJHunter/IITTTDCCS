<div>
    <form action="addUser.php" method="post">
	<table class='modifyUsers'>
		<tr>
			<th colspan='4'>Add/Edit a User:<input type="hidden" name="uType" value="user"><input type="hidden" name="add" value="1"></th>
		</tr><tr>
			<td class='leftColumn'>First Name:</td>
                        <td><input name="fName" placeholder="John" type='text'></td>
			<td class='leftColumn'>Position:</td>
			<td><input name="title" placeholder="Doctor" type="text"></td>
		</tr><tr>
                        <td class='leftColumn'>Last Name:</td>
			<td><input name="lName" placeholder="Smith" type='text'></td>
			<td class='leftColumn'>Access:</td>
			<td><input type='radio' name='acc' value='2'>2 (Doctor)<input type='radio' name='acc' value='3'>3 (Administration)<br><input type='radio' name='acc' value='4'>4 (Technical Support)</td>
		</tr><tr>
			<td colspan='4'>
				<table align='center'>
					<tr>
						<td>Username:<br><input name="uName" placeholder="User_John" type='text'></td>
						<td>Password:<br><input name="pWord" placeholder="password" type='text'></td>
					</tr>
				</table>
		</tr><tr>
			<td class='leftColumn'>Email:</td>
			<td><input name="email" placeholder="JSmith@example.com" type='text'></td>
			<td rowspan='2'><input type='submit' value='Add/Update User'></td>
		</tr><tr>
			<td class='leftColumn'>Phone Number:</td>
			<td><input name="phone" placeholder="1234567890" type='text'></td>
		</tr>
	</table>
    </form>
</div>
<br><br>
<div id='sendForm'>
	Audit forms
	<form action='index.php' method='get'>
		Send in time period:
		<select name='timePeriod'>
			<option value='2019-11-06'>June 1st - June 30th, 2019</option>
			<option value='2019-11-07'>July 1st - July 31st, 2019</option>
			<option value='2019-11-08'>August 1st - August 31st, 2019</option>
		</select><br><br>
		<div style='text-align:center'>Last Audit performed on 2019-08-01</div><br>
		Audit performed by:<?php echo $_SESSION['FirstName'] . " " . $_SESSION['LastName']; ?><br>
		Audit overseen by:<input type='input' name='manager'><br><br><br>
		Terms of service: <input type='checkbox' name='terms'><br><br>
		<div  class='centeredSubmit'><input type='submit' value='Send'></div>
	</form>
</div>
<br><br>
<div class='modifyUsers'>
Manage Devices
<table id='machineAccessTable'>
	<tr>
		<td>User</td><td>Machine name</td><td>MAC address</td><td>Port</td><td>Active</td><td>Update</td>
	</tr><tr>
		<td><input type='input'></td><td><input type='input'></td><td><input type='input' size='16'></td><td><input type='input' size='5'></td><td><input type='checkbox'></td><td><input type='submit' value='update'></td>
	</tr><tr>
		<td><input type='input'></td><td><input type='input'></td><td><input type='input' size='16'></td><td><input type='input' size='5'></td><td><input type='checkbox'></td><td><input type='submit' value='update'></td>
	</tr>
</table>
</div>
<br><br>
