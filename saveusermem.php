<?php
@session_start();
include("connectdb.php");

// ===============================
// ✅ BASIC USER DATA
// ===============================
$username = $_POST["usname"];
$password=$_POST["pass"];
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


mysqli_query($con,"insert into users (name,email,password,role,created_at) values('$username','$email','$password','user',NOW())");

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
(user_id, zone_id, city_id, phone, address, photo, created_at, gender, dob, fullname, plan_id) 
VALUES 
('$user_id', '$zone_id', '$city_id', '$phone', '$address', '$img', NOW(), '$gender','$dob','$fullname','$plan_id')
");

$member_id = mysqli_insert_id($con);

// ===============================
// ✅ INSERT REQUEST FOR ADMIN APPROVAL
// ===============================
// mysqli_query($con,"
// INSERT INTO plan_requests 
// (user_id, plan_id, status, request_date) 
// VALUES 
// ('$member_id', '$plan_id', 'approved', NOW())
// ");

// ===============================
// ✅ MEMBER APPROVAL REQUEST (PROFILE SIDE)
// ===============================
mysqli_query($con,"
INSERT INTO requests (member_id, status, request_date) 
VALUES ('$member_id', 'pending', NOW())
");

// mysqli_query($con,"update users set onboarding=1 where id='$uid'");



// ===============================
// ✅ REDIRECT TO ADMIN PAGE
// ===============================
header("Location: successpage.php?success=1");
exit;

?>
