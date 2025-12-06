<?php
@session_start();
include("connectdb.php");

// ===============================
// ✅ BASIC USER DATA
// ===============================
$username = $_POST["username"];
$email    = $_POST["email"];
$fullname = $_POST["fullname"];
$gender   = $_POST["gender"];
$dob      = $_POST["dob"];
$phone    = $_POST["phone"];

// ===============================
// ✅ ADDRESS DATA
// ===============================
$zone_id  = $_POST["zone_id"];
$city_id  = $_POST["city_id"];
$address  = $_POST["address"];

// ===============================
// ✅ PLAN DATA (NEW ADDITION)
// ===============================
$plan_id  = $_POST["plan_id"];   // 🔥 Form se aayega

// ===============================
// ✅ IMAGE UPLOAD
// ===============================
$file = $_FILES["photo"];
$img = time()."_".$file["name"];
move_uploaded_file($file["tmp_name"], "upload/member/".$img);

// ===============================
// ✅ CREATE USER ACCOUNT
// ===============================
mysqli_query($con,"
INSERT INTO users (name,email,role,created_at,onboarding) 
VALUES ('$username', '$email','user',NOW(),1)
");

$user_id = mysqli_insert_id($con);

// ===============================
// ✅ GET PLAN DETAILS
// ===============================
$p = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM plans WHERE plan_id='$plan_id'"));

$plan_start = date('Y-m-d');

if($p['duration_days'] != NULL){
    $plan_end = date('Y-m-d', strtotime("+".$p['duration_days']." days"));
}else{
    $plan_end = NULL; // ✅ Lifetime
}

// ===============================
// ✅ INSERT INTO MEMBERS
// ===============================
$insert = mysqli_query($con,"
INSERT INTO members 
(user_id, zone_id, city_id, phone, address, photo, created_at, gender, dob, fullname, plan_id, membership_start, membership_end) 
VALUES 
('$user_id', '$zone_id', '$city_id', '$phone', '$address', '$img', NOW(), '$gender','$dob','$fullname','$plan_id','$plan_start','$plan_end')
");

$member_id = mysqli_insert_id($con);

// ===============================
// ✅ INSERT REQUEST FOR ADMIN APPROVAL
// ===============================
mysqli_query($con,"
INSERT INTO plan_requests 
(user_id, plan_id, status, request_date) 
VALUES 
('$member_id', '$plan_id', 'approved', NOW())
");

// ===============================
// ✅ MEMBER APPROVAL REQUEST (PROFILE SIDE)
// ===============================
mysqli_query($con,"
INSERT INTO requests (member_id, status, request_date, approved_date) 
VALUES ('$member_id', 'approved', NOW(), NOW())
");

mysqli_query($con,"
INSERT INTO wallet (member_id, amount) 
VALUES ('$member_id', 0)
");

// ===============================
// ✅ REDIRECT TO ADMIN PAGE
// ===============================
header("Location: adminaddmem.php?success=1&member_id=".$member_id);
exit;

?>
