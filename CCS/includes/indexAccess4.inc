You can create and destroy admin, doctor and support accounts.<br><br>
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