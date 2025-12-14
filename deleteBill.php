<?php
include("connectdb.php");

$bill_id   = $_GET['bill_id'];
$member_id = $_GET['member_id'];

// get bill amount first
$q = mysqli_query($con,"SELECT bill_amount FROM sens_bills WHERE bill_id='$bill_id'");
$row = mysqli_fetch_assoc($q);
$bill_amount = $row['bill_amount'];

mysqli_begin_transaction($con);

try {

  // 1️⃣ Delete bill
  mysqli_query($con,"DELETE FROM sens_bills WHERE bill_id='$bill_id'");

  // 2️⃣ Subtract from balance
  mysqli_query($con,"
    UPDATE sens_members
    SET balance_amount = balance_amount - $bill_amount
    WHERE member_id='$member_id'
  ");

  mysqli_commit($con);
  header("Location: manageBills.php");

} catch (Exception $e) {
  mysqli_rollback($con);
  echo "Error deleting bill";
}
