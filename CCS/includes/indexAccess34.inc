<div>
    <form action="addUser.php" method="post">
	<table class='modifyUsers'>
		<tr>
			<th colspan='4'>Add/Edit a Patient:<input type="hidden" name="uType" value="patient"><input type="hidden" name="add" value="1"></th>
		</tr><tr>
			<td class='leftColumn'>Given Name:</td>
                        <td><input name="fName" placeholder="John" type='text'></td>
			<td class='leftColumn'>Date of birth:</td>
			<td><input name="DoB" placeholder="YYYY-MM-DD" type="text"></td>
		</tr><tr>
			<td class='leftColumn'>Family Name:</td>
			<td><input name="lName" placeholder="Smith" type='text'></td>
			<td class='leftColumn'>Sex:</td>
			<td><input type='radio' name='sex' value='m'>Male<input type='radio' name='sex' value='f'>Female<input type='radio' name='sex' value='o'>Other<!-- Because someone WILL yell about this --></td>
		</tr><tr>
			<td colspan='4'>
				<table align='center'>
					<tr>
						<td>Unit:<br><input name="unit" placeholder="" type='text' size='2'></td>
                                                <td>Address:<br><input name="addr" placeholder="123" type='text' size='16'></td>
						<td>Street:<br><input name="street" placeholder="Fake Street" type='text' size='16'></td>
						<td>City:<br><input name="city" placeholder="Adelaide" type='text' size='14'></td>
					</tr>
				</table><table align='center'>
					<tr>
						<td class='leftColumn'>Postcode: </td>
						<td> <input name="pCode" placeholder="1234" type='text' size='8'> </td>
						<td class='leftColumn'>Country: </td>
						<td> <input name="count" placeholder="Australia" type='text' size='12'> </td>
					</tr>
				</table>
		</tr><tr>
			<td class='leftColumn'>Medical No.:</td>
			<td><input name="Medno" placeholder="1234567891" type='text' required></td>
			<td class='leftColumn' rowspan='2'><input name="search" type='submit' value='1'></td>
			<td rowspan='2'><input type='submit' value='Update Patient'><input name="delete" type='checkbox'><span id='formCheckDel'>Del</span></td>
		</tr><tr>
			<td class='leftColumn'>Medicare IRV:</td>
			<td><input name="MCIRV" placeholder="0" type='text'></td>
		</tr>
	</table>
    </form>
</div>

<br><br>