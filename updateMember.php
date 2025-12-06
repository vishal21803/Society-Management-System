<?php
include("connectdb.php");

$id      = $_POST['id'];
$name    = $_POST['fullname'];
$phone   = $_POST['phone'];
$gender  = $_POST['gender'];
$dob     = $_POST['dob'];
$address = $_POST['address'];
$start   = $_POST['start'];
$end     = $_POST['end'];
$zone    = $_POST['zone'];
$city    = $_POST['city'];
$plan    = $_POST['plan'];

$update = mysqli_query($con,"
UPDATE members SET 
 fullname='$name',
 phone='$phone',
 gender='$gender',
 dob='$dob',
 address='$address',
 membership_start='$start',
 membership_end='$end',
 zone_id='$zone',
 city_id='$city',
 plan_id='$plan'
WHERE member_id='$id'
");

echo $update ? "success" : "error";
?>
