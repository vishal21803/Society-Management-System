<?php
include("connectdb.php");

$req_id = $_GET['req_id'];

// Request ka data nikaalo
$q = mysqli_fetch_assoc(mysqli_query($con,"
SELECT * FROM plan_requests WHERE req_id='$req_id'
"));

$user_id = $q['user_id'];
$plan_id = $q['plan_id'];

// Plan ka duration nikaalo
$p = mysqli_fetch_assoc(mysqli_query($con,"
SELECT * FROM plans WHERE plan_id='$plan_id'
"));

$start = date('Y-m-d');

if($p['duration_days'] != NULL){
   $end = date('Y-m-d', strtotime("+".$p['duration_days']." days"));
} else {
   $end = NULL; // lifetime
}

// ✅ MEMBERS TABLE UPDATE
mysqli_query($con,"
UPDATE members 
SET plan_id='$plan_id',
    membership_start='$start',
    membership_end=" . ($end ? "'$end'" : "NULL") . "
WHERE member_id='$user_id'
");

// ✅ Request status approved
mysqli_query($con,"
UPDATE plan_requests 
SET status='approved' 
WHERE req_id='$req_id'
");

header("location:admin_plan_requests.php?msg=approved");
?>
