<?php
if(isset($_GET['searchfor'])){
    require 'admin/includes/dbconnect.inc';
    $query = "SELECT * FROM `Patient_Details` WHERE `Medicare No.` = " . htmlspecialchars(stripslashes(strip_tags($_GET['searchfor'])));
    $result = mysqli_query($conn, $query);
    $patient = mysqli_fetch_row($result);
    $conn->close();
}
?>
<div>
    <form action="addUser.php" method="post">
        <input type='hidden' name='PID' value='<?php echo $patient[0];?>'>
	<table class='modifyUsers'>
		<tr>
			<th colspan='4'>Add/Edit a Patient:<input type="hidden" name="uType" value="patient"></th>
		</tr><tr>
			<td class='leftColumn'>Given Name:</td>
                        <td><input name="fName" placeholder="John" type='text' value='<?php echo $patient[1]; ?>'></td>
			<td class='leftColumn'>Date of birth:</td>
			<td><input name="DoB" placeholder="YYYY-MM-DD" type="text" value='<?php echo $patient[8]; ?>'></td>
		</tr><tr>
			<td class='leftColumn'>Family Name:</td>
			<td><input name="lName" placeholder="Smith" type='text' value='<?php echo $patient[2]; ?>'></td>
			<td class='leftColumn'>Sex:</td>
                        <td><input type='radio' name='sex' value='m' <?php if(strtolower($patient[9]) == "m" || strtolower($patient[9]) == "male"){echo 'checked';} ?>>Male<input type='radio' name='sex' value='f' <?php if(strtolower($patient[9]) == "f" || strtolower($patient[9]) == "female"){echo 'checked';} ?>>Female<input type='radio' name='sex' value='o' <?php if(strtolower($patient[9]) == "o" || strtolower($patient[9]) == "other"){echo 'checked';} ?>>Other<!-- Because someone WILL yell about this --></td>
		</tr><tr>
			<td colspan='4'>
				<table align='center'>
					<tr>
						<td>Unit:<br><input name="unit" placeholder="" type='text' size='2' value='<?php echo $patient[3]; ?>'></td>
                                                <td>Address:<br><input name="addr" placeholder="123" type='text' size='16' value='<?php echo $patient[4]; ?>'></td>
						<td>Street:<br><input name="street" placeholder="Fake Street" type='text' size='16' value='<?php echo $patient[5]; ?>'></td>
						<td>City:<br><input name="city" placeholder="Adelaide" type='text' size='14' value='<?php echo $patient[6]; ?>'></td>
					</tr>
				</table><table align='center'>
					<tr>
						<td class='leftColumn'>Postcode: </td>
						<td> <input name="pCode" placeholder="1234" type='text' size='8' value='<?php echo $patient[7]; ?>'> </td>
						<td class='leftColumn'>Country: </td>
						<td> <input name="count" placeholder="Australia" type='text' size='12' value='<?php echo "Australia"; //99% certain this is true. Program only rated for use in Australia. ?>'> </td>
					</tr>
				</table>
		</tr><tr>
			<td class='leftColumn'>Medical No.:</td>
			<td><input name="Medno" placeholder="1234567891" type='text' value="<?php echo htmlspecialchars(stripslashes(strip_tags($_GET['searchfor']))); ?>" required></td>
			<td class='leftColumn' rowspan='2'><input name="search" type='submit' value='Search'></td>
			<td rowspan='2'><input type='submit' value='Update Patient'><input name="delete" type='checkbox'><span id='formCheckDel'>Del</span><input name="add" type='checkbox'>Add</td>
		</tr><tr>
			<td class='leftColumn'>Medicare IRV:</td>
			<td><input name="MCIRV" placeholder="0" type='text' value='<?php echo $patient[11] ?>'></td>
		</tr>
	</table>
    </form>
</div>

<br><br>