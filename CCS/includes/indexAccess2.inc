<?php
require 'admin/includes/dbconnect.inc';
$query = "SELECT * FROM `Patient_Details`";
$result = mysqli_query($conn, $query);
$query = "SELECT * FROM `Procedure_Case_User` WHERE `Procedure Date/Time` BETWEEN '" . date("Y-m-d", strtotime($startDate . "-1 day")) . " 00:00:00' AND '" . date("Y-m-d", strtotime($startDate . "+1 day")) . " 23:59:59'";
$resulttwo = mysqli_query($conn, $query);
$conn->close();
?>
<div id='PTTitle'>Paperwork</div>
<div id='PT'>
    <div class='PTrow'>
        <div class='PTEmpty'>&nbsp;</div>
        <div id='PTGroup'>
            <div class='PTHeading'>Patient Name</div>
            <div class='PTHeading'><?php echo date("M d", strtotime($startDate . "-1 day")) . " - " . date("M d", strtotime($startDate . "+1 day")); ?></div>
            <div id='PTScrollSpace' class='PTHeading'>Forms Filed</div>
        </div>
        <div class='patientTableEmpty'>&nbsp;</div>
    </div>
    <div class='PTrow'>
        <div class='PTArrowContainer'><a href='<?php echo $URLBuilderPaperArrows . "&startDate=" . date("Y-m-d", strtotime($startDate . "-3 days")); ?>'><img class='PTArrowLeft' src='images/left.png' alt=''></a></div>
        <div id='PTGroup'>
            <div id='PTContainer'>
                <table id='PTTable'>
                    <?php
                    while ($rowproc = mysqli_fetch_row($resulttwo)) {
                        do {
                        $row = mysqli_fetch_row($result);
                        } while ($row[0] != $rowproc[4]);
                        $resultDate = $rowproc[5];
                        echo "<tr>";
                        echo "<td class='PTCell'>" . (is_string($row[1]) && is_string($row[2]) ? $row[2] . ", " . substr($row[1], 0, 1) : "#NAME?") . "</td>";
                        echo "<td class='PTCell'>" . (isset($resultDate) ? $resultDate : "#DATE?") . "</td>";
                        echo "<td class='PTCell'><form action=\"patientDetails.php\" method=\"post\"><input type='hidden' name='case' value='" . $rowproc[2] . "'><input class='PTButton' type='submit' value='View'></form></td>";
                        echo "</tr>";
                        unset($resultDate);
                        mysqli_data_seek($result, 0);
                    }
                    ?>
                </table>
            </div>
        </div>
        <div class='PTArrowContainer'><a href='<?php echo $URLBuilderPaperArrows . "&startDate=" . date("Y-m-d", strtotime($startDate . "+3 days")); ?>'><img class='PTArrowRight' src='images/right.png' alt=''></a></div>
    </div>
</div>
<div style='text-align:right;'><a style="margin-right:50px;" href='<?php echo $URLBuilderAdvSearch; if ( $linkAdvSearch ) {}else {echo "&advSearch=on";} ?>'>Patient Search</a></div>
<br><br>
