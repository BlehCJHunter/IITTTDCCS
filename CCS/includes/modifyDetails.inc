<?php

$ref = htmlspecialchars(stripslashes(strip_tags($_SERVER['HTTP_REFERER'])));
foreach ($_POST as $key => $value) {
    ${htmlspecialchars(stripslashes(strip_tags($key)))} = htmlspecialchars(stripslashes(strip_tags($value)));
}
$f1 = 1; //First?
$f2 = 1;
switch ($loc) {
    case 'Next':
        $target = 'Location: codingDetails.php?case=' . $CID;
        break;

    /*case 'Finish':
        $target = 'Location: index.php';
        break;*/

    default:
        $target = 'Location: index.php';
        break;
}
switch ($ref) {
    case "https://ccs.geekrunner.net/CCS/patientDetails.php":
        if (preg_match("/^\d+( )\D+(, ).+$/i", $addr)) {
            preg_match("/\d+(?= )/i", $addr, $address);
            $num = $address[0];
            preg_match("/[^\d\s].*(?=, )/i", $addr, $address);
            $st = $address[0];
            preg_match("/\w+$/i", $addr, $address);
            $city = $address[0];
        }
        if (preg_match("/^\d+( )\d+( ).+(, ).+$/i", $addr)) {
            preg_match_all("/\d+/", $addr, $address, PREG_PATTERN_ORDER);
            $unit = $address[0][0];
            $num = $address[0][1];
            preg_match("/[^\d\s].*(?=, )/i", $addr, $address);
            $st = $address[0];
            preg_match("/\w+$/i", $addr, $address);
            $city = $address[0];
        }
        $query = "UPDATE `Patient_Details` SET ";
        if (isset($uniqueID) && strlen($uniqueID) > 3) {
            $query .= ($f1 ? "" : ", ") . "`Medicare No.` = '" . $uniqueID . "'";
            $f1 = 0;
        }
        if (isset($dateOfBirth) && strlen($dateOfBirth) > 3) {
            $query .= ($f1 ? "" : ", ") . "`DOB` = '" . $dateOfBirth . "'";
            $f1 = 0;
        }
        if (isset($unit) && strlen($unit) > 0) {
            $query .= ($f1 ? "" : ", ") . "`Unit No.` = '" . $unit . "'";
            $f1 = 0;
        }
        if (isset($num) && strlen($num) > 0) {
            $query .= ($f1 ? "" : ", ") . "`Street No.` = '" . $num . "'";
            $f1 = 0;
        }
        if (isset($st) && strlen($st) > 0) {
            $query .= ($f1 ? "" : ", ") . "`Address` = '" . $st . "'";
            $f1 = 0;
        }
        if (isset($city) && strlen($city) > 0) {
            $query .= ($f1 ? "" : ", ") . "`City` = '" . $city . "'";
            $f1 = 0;
        }
        $query .= " WHERE `Patient ID` = '" . $PID . "'";
        require 'admin/includes/dbconnect.inc';
        if (mysqli_query($conn, $query)) {
            echo "Record updated successfully";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
            $conn->close();
            exit();
        }
        break;
    case "https://ccs.geekrunner.net/CCS/codingDetails.php":
        $queryone = "UPDATE `Procedure_Case_User` SET ";
        $querytwo = "UPDATE `Symptom_Case_User` SET ";
        if (isset($assessmentDate) && strlen($assessmentDate) > 0) {
            $queryone .= ($f1 ? "" : ", ") . "`Procedure Date/Time` = '" . $assessmentDate . "'";
            $querytwo .= ($f2 ? "" : ", ") . "`Date/Time Submitted` = '" . $assessmentDate . "'";
            $f1 = 0;
            $f2 = 0;
        }
        if (isset($procedure)) {
            $queryone .= ($f1 ? "" : ", ") . "`Procedure Code ID` = '" . $_POST['procedure'][0] . "'";
            $f1 = 0;
        }
        switch ($agreed) {
            case "on":
                $queryone .= ($f1 ? "" : ", ") . "`Procedure Validation` = 1";
                $f1 = 0;
                break;

            default:
                $queryone .= ($f1 ? "" : ", ") . "`Procedure Validation` = 0";
                $f1 = 0;
                break;
        }
        if (isset($diagnosis)) {
            $querytwo .= ($f2 ? "" : ", ") . "`Symptom Code ID` = '" . $_POST['diagnosis'][0] . "'";
            $f2 = 0;
        }
        if (isset($pcomments) && strlen($pcomments) > 0) {
            $queryone .= ($f1 ? "" : ", ") . "`Procedure Comments` = '" . trim($pcomments) . "'";
            $f1 = 0;
        }
        if (isset($scomments) && strlen($scomments) > 0) {
            $querytwo .= ($f2 ? "" : ", ") . "`Symptom Comments` = '" . trim($scomments) . "'";
            $f2 = 0;
        }
        $queryone .= " WHERE `Case ID` = '" . $CID . "'";
        $querytwo .= " WHERE `Case ID` = '" . $CID . "'";
        echo $queryone . "<br>" . $querytwo;
        require 'admin/includes/dbconnect.inc';
        if (mysqli_query($conn, $queryone)) {
            echo "Record updated successfully";
        } else {
            echo "Error: " . $queryone . "<br>" . mysqli_error($conn);
            $conn->close();
            exit();
        }
        if (mysqli_query($conn, $querytwo)) {
            echo "Record updated successfully";
        } else {
            echo "Error: " . $querytwo . "<br>" . mysqli_error($conn);
            $conn->close();
            exit();
        }
        break;
}
echo $ref;
header($target);
?>