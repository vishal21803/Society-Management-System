<?php
@session_start();
include("connectdb.php");



$member_id   = $_SESSION['member_id'];
$fam_name    = $_POST['fam_name'];
$fam_gender  = $_POST['fam_gender'];
$fam_phone   = $_POST['fam_phone'];

$fam_relation = $_POST['fam_relation'];

if($fam_relation == "Other") {
    $fam_relation = $_POST['other_relation'];  // custom value
}



$dob = $_POST['fam_dob'];
$edu = $_POST['fam_edu'];


$created_by   = $_SESSION['uname'];

$q = mysqli_query($con,"
INSERT INTO sens_family(member_id, fam_name, fam_gender, fam_phone, fam_relation, created_by,fam_dob,fam_education)
VALUES('$member_id', '$fam_name', '$fam_gender', '$fam_phone', '$fam_relation', '$created_by','$dob','$edu')
");

    header("location:addFamily.php?success=1");


?>
