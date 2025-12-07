<?php
session_start();
include("connectdb.php");

$request_id = intval($_POST['request_id']);
$status     = $_POST['status'];

/* ✅ 1. Update Request Status */
mysqli_query($con, "
    UPDATE sens_requests 
    SET status='$status', approved_date=NOW() 
    WHERE request_id='$request_id'
");

/* ✅ 2. Get MEMBER ID from REQUESTS */
$res = mysqli_query($con, "
    SELECT member_id 
    FROM sens_requests 
    WHERE request_id='$request_id'
");

$row = mysqli_fetch_assoc($res);
$member_id = $row['member_id'];

/* ✅ 3. Get PLAN ID from MEMBERS */
$res2 = mysqli_query($con, "
    SELECT plan_id 
    FROM sens_members 
    WHERE member_id='$member_id'
");

$row2   = mysqli_fetch_assoc($res2);
$plan_id = $row2['plan_id'];

/* ✅ 4. Insert into PLAN_REQUESTS */
mysqli_query($con, "
    INSERT INTO sens_plan_requests 
    (user_id, plan_id, status) 
    VALUES 
    ('$member_id', '$plan_id', 'approved')
");

/* ✅ 5. Get PLAN DURATION */
$p = mysqli_fetch_assoc(
    mysqli_query($con, "SELECT * FROM sens_plans WHERE plan_id='$plan_id'")
);

/* ✅ 6. Set MEMBERSHIP START & END */
$plan_start = date('Y-m-d');

if (!empty($p['duration_days'])) {
    $plan_end = date('Y-m-d', strtotime("+".$p['duration_days']." days"));
} else {
    $plan_end = NULL; // ✅ Lifetime Plan
}

/* ✅ 7. Update MEMBERS Table */
mysqli_query($con, "
    UPDATE sens_members 
    SET 
        membership_start='$plan_start',
        membership_end=".($plan_end ? "'$plan_end'" : "NULL")."
    WHERE member_id='$member_id'
");



mysqli_query($con,"
INSERT INTO sens_wallet (member_id, amount) 
VALUES ('$member_id', 0)
");


echo "Updated";
?>
