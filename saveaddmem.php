<?php
@session_start();
include("connectdb.php");
$uname=$_SESSION["uname"];

// ===============================
// ✅ BASIC USER DATA
// ===============================
$email    = $_POST["email"];
$fullname = $_POST["fullname"];
// $gender   = $_POST["gender"];
// $dob      = $_POST["dob"];
$phone    = $_POST["phone"];

// ===============================
// ✅ ADDRESS DATA
// ===============================
$zone_id  = $_POST["zone_id"];
$city_id  = $_POST["city_id"];
// $address  = $_POST["address"];

// ===============================
// ✅ PLAN DATA (NEW ADDITION)
// ===============================
$plan_id  = $_POST["plan_id"];   // 🔥 Form se aayega

// ===============================
// ✅ IMAGE UPLOAD
// ===============================
// $file = $_FILES["photo"];
// $img = time()."_".$file["name"];
// move_uploaded_file($file["tmp_name"], "upload/member/".$img);

// ===============================
// ✅ CREATE USER ACCOUNT
// ===============================
mysqli_query($con,"
INSERT INTO sens_users (name,email,role,created_at,onboarding,created_by) 
VALUES ('$fullname', '$email','user',NOW(),1,'$uname')
");

$user_id = mysqli_insert_id($con);

// ===============================
// ✅ GET PLAN DETAILS
// ===============================
$p = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM sens_plans WHERE plan_id='$plan_id'"));

$plan_start = date('Y-m-d');



// ===============================
// ✅ INSERT INTO MEMBERS
// ===============================
$insert = mysqli_query($con,"
INSERT INTO sens_members 
(user_id, zone_id, city_id, phone, created_at,fullname, plan_id, membership_start,created_by) 
VALUES 
('$user_id', '$zone_id', '$city_id', '$phone',  NOW(), '$fullname','$plan_id','$plan_start','$uname')
");

$member_id = mysqli_insert_id($con);

// ===============================
// ✅ INSERT REQUEST FOR ADMIN APPROVAL
// ===============================
// mysqli_query($con,"
// INSERT INTO sens_plan_requests 
// (user_id, plan_id, status, request_date,created_by) 
// VALUES 
// ('$member_id', '$plan_id', 'approved', NOW(),'$uname')
// ");

// ===============================
// ✅ MEMBER APPROVAL REQUEST (PROFILE SIDE)
// ===============================
mysqli_query($con,"
INSERT INTO sens_requests (member_id, status, request_date, approved_date,created_by) 
VALUES ('$member_id', 'approved', NOW(), NOW(),'$uname')
");


// ===============================
// ✅ REDIRECT TO ADMIN PAGE
// ===============================
header("Location: adminRegisForm.php?success=1&member_id=".$member_id);
exit;

?>
