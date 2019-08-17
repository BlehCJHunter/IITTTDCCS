<?php
if (isset($_GET['usearchfor'])) {
    require 'admin/includes/dbconnect.inc';
    $query = "SELECT * FROM `Users` WHERE `Username` = '" . htmlspecialchars(stripslashes(strip_tags($_GET['usearchfor']))) . "'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_row($result);
    $conn->close();
}
?>
You can create and destroy admin, doctor and support accounts.<br><br>
<div>
    <form action="addUser.php" method="post">
        <input type='hidden' name='access' value='<?php echo (isset($_GET['AUI']) ? $_GET['AUI'] : $_SESSION['access']); ?>
               <input type='hidden' name='UID' value='<?php echo $user[0]; ?>'>
               <table class='modifyUsers'>
            <tr>
                <th colspan='4'>Add/Edit a User:<input type="hidden" name="uType" value="user"></th>
            </tr><tr>
                <td class='leftColumn'>First Name:</td>
                <td><input name="fName" placeholder="John" type='text' value='<?php echo $user[1]; ?>'></td>
                <td class='leftColumn'>Position:</td>
                <td><input name="title" placeholder="Doctor" type="text" value='<?php echo $user[3]; ?>'></td>
            </tr><tr>
                <td class='leftColumn'>Last Name:</td>
                <td><input name="lName" placeholder="Smith" type='text' value='<?php echo $user[2]; ?>'></td>
                <td class='leftColumn'>Access:</td>
                <td><input type='radio' name='acc' value='2' <?php if ($user[4] == 2) {
    echo 'checked';
} ?>>2 (Doctor)<input type='radio' name='acc' value='3'<?php if ($user[4] == 3) {
    echo 'checked';
} ?>>3 (Administration)<br><input type='radio' name='acc' value='4'<?php if ($user[4] == 4) {
    echo 'checked';
} ?>>4 (Technical Support)</td>
            </tr><tr>
                <td colspan='4'>
                    <table align='center'>
                        <tr>
                            <td>Username:<br><input name="uName" placeholder="User_John" type='text' required value='<?php echo $user[5]; ?>'></td>
                            <td>Password:<br><input name="pWord" placeholder="password" type='text'></td>
                        </tr>
                    </table>
            </tr><tr>
                <td class='leftColumn'>Email:</td>
                <td><input name="email" placeholder="JSmith@example.com" type='text' value='<?php echo $user[8]; ?>'></td>
                <td class='leftColumn' rowspan='2'><input name="search" type='submit' value='Search'></td>
                <td rowspan='2'><input type='submit' value='Update User'><input name="delete" type='checkbox'><span id='formCheckDel'>Del</span><input name="add" type='checkbox'>Add</td>
            </tr><tr>
                <td class='leftColumn'>Phone Number:</td>
                <td><input name="phone" placeholder="1234567890" type='text' value='<?php echo $user[9]; ?>'></td>
            </tr>
        </table>
    </form>
</div>
<br><br>
<div id='sendForm'>
	<div class='alert' style='text-align:center'>Work in progress - Not working</div>
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
