<?php
@session_start();
include("connectdb.php");

$fullname  = $_POST["fullname"];
$gender    = $_POST["gender"];
$dob       = $_POST["dob"];
$phone     = $_POST["phone"];
$file      = $_FILES["photo"];

$state_id  = $_POST["state_id"];
$zone_id   = $_POST["zone_id"];
$city_id   = $_POST["city_id"];
$address   = $_POST["address"];
$gender=$_POST["gender"];
$dob=$_POST["dob"];

$user_id   = $_SESSION["uid"]; // logged in user

//----------------------------------
// ✅ IMAGE UPLOAD
//----------------------------------
$img = time()."_".$file["name"];
move_uploaded_file($file["tmp_name"], "upload/member/".$img);

//----------------------------------
// ✅ CORRECTED INSERT QUERY
//----------------------------------
$insert = mysqli_query($con,"
INSERT INTO members 
(user_id, zone_id, city_id, phone, address, photo, created_at,gender,dob) 
VALUES 
('$user_id', '$zone_id', '$city_id', '$phone', '$address', '$img', NOW(), '$gender','$dob')
");

//----------------------------------
// ✅ GET LAST INSERTED MEMBER ID
//----------------------------------
$member_id = mysqli_insert_id($con);

mysqli_query($con,"INSERT INTO requests (member_id, status, request_date) VALUES ('$member_id', 'pending', NOW())");
//----------------------------------
// ✅ UPDATE USER STATUS
//----------------------------------
mysqli_query($con,"UPDATE users SET onboarding=1 WHERE id='$user_id'");

//----------------------------------
// ✅ REDIRECT
//----------------------------------
header("Location: userPage.php?member_id=".$member_id);
exit;
?>
