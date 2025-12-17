<?php
include("connectdb.php");

$id = $_POST['fam_id'];

$fam_name      = $_POST['fam_name'];
$fam_gender    = $_POST['fam_gender'];
$fam_phone     = $_POST['fam_phone'];
$fam_relation  = $_POST['fam_relation'];
$fam_dob       = $_POST['fam_dob'];
$fam_education = $_POST['fam_education'];
$fam_marry = $_POST['fam_marry'];


$q = mysqli_query($con,"
    UPDATE sens_family SET 
       
        fam_name      = '$fam_name',
        fam_gender    = '$fam_gender',
        fam_phone     = '$fam_phone',
        fam_relation  = '$fam_relation',
        fam_dob       = '$fam_dob',
        fam_education = '$fam_education',
        marry_status= '$fam_marry'
    WHERE fam_id = '$id'
");

echo $q ? "success" : "error";
?>
