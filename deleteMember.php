<?php
include("connectdb.php");
$id = $_POST['id'];

// First fetch user_id
$rs = mysqli_query($con, "SELECT user_id FROM sens_members WHERE member_id='$id'");
$row = mysqli_fetch_assoc($rs);
$user_id = $row['user_id'];

// Now delete all related data
mysqli_query($con,"DELETE FROM sens_family WHERE member_id='$id'");
mysqli_query($con,"DELETE FROM sens_receipt WHERE member_id='$id'");
mysqli_query($con,"DELETE FROM sens_bills WHERE member_id='$id'");
mysqli_query($con,"DELETE FROM sens_messages WHERE sender_id='$id'");
mysqli_query($con,"DELETE FROM sens_requests WHERE member_id='$id'");
mysqli_query($con,"DELETE FROM sens_members WHERE member_id='$id'");

// Finally delete user record
mysqli_query($con,"DELETE FROM sens_users WHERE id='$user_id'");

echo "success";
?>
