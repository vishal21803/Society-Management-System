<?php
include("connectdb.php");

$bill_id     = $_POST['bill_id'];
$member_id   = $_POST['member_id'];
$old_amount  = $_POST['old_amount'];
$new_amount  = $_POST['new_amount'];
$purpose     = $_POST['purpose'];
$type=$_POST['type'];
$manid=$_POST['manid'];
$recidate=$_POST['recidate'];



mysqli_begin_transaction($con);

try {

  // 1️⃣ Update bill
  mysqli_query($con,"
    UPDATE sens_receipt
    SET receipt_amount='$new_amount', purpose='$purpose', receipt_type='$type',manualID='$manid',recdate='$recidate'
    WHERE receipt_id='$bill_id'
  ");

  // 2️⃣ Update balance
  mysqli_query($con,"
    UPDATE sens_members
    SET balance_amount = balance_amount + $old_amount - $new_amount 
    WHERE member_id='$member_id'
  ");

  mysqli_commit($con);
  header("Location: manageReceipt.php");

} catch (Exception $e) {
  mysqli_rollback($con);
  echo "Error updating Receipt";
}
