<?php
@session_start();
include("connectdb.php");

$user_id = $_SESSION['member_id'];   // ya user_id jo tum use karte ho
$plan_id = $_GET['plan_id'];     // 1 = Yearly

// Ek nayi request insert karo (pending approval)
mysqli_query($con, "
INSERT INTO plan_requests 
(user_id, plan_id, request_date, status)
VALUES 
('$user_id', '$plan_id', CURDATE(), 'pending')
");

header("location:showPlans.php?msg=plan_requested");
?>
