<?php
include("connectdb.php");

$bill_id     = $_POST['bill_id'];
$member_id   = $_POST['member_id'];
$old_amount  = $_POST['old_amount'];
$new_amount  = $_POST['new_amount'];
$purpose     = $_POST['purpose'];
$type=$_POST['type'];
$bdate=$_POST['bildate'];

mysqli_begin_transaction($con);

try {

  // 1️⃣ Update bill
  mysqli_query($con,"
    UPDATE sens_bills
    SET bill_amount='$new_amount', bill_purpose='$purpose', bill_type='$type',bdate='$bdate'
    WHERE bill_id='$bill_id'
  ");

  // 2️⃣ Update balance
  mysqli_query($con,"
    UPDATE sens_members
    SET balance_amount = balance_amount - $old_amount + $new_amount 
    WHERE member_id='$member_id'
  ");

  mysqli_commit($con);
  header("Location: manageBills.php");

} catch (Exception $e) {
  mysqli_rollback($con);
  echo "Error updating bill";
}
