<?php
@session_start();
include("connectdb.php");

$uname=$_SESSION["uname"];
$member_id = $_POST['member_id'];
$amount    = $_POST['amount'];
$year = date('Y'); // ✅ Current Year

// $receipt   = $_POST['receipt_no'];
// $note      = $_POST['note'];
// $createdBy = $_SESSION['uname'];   // admin ka username
$date      = date("Y-m-d");

/* ✅ 1. PAYMENT INSERT */
mysqli_query($con, "
INSERT INTO sens_payments
(member_id, amount, payment_date,payment_for_year,created_by)
VALUES
('$member_id', '$amount', '$date' ,'$year','$uname')
");

mysqli_query($con,"
    UPDATE sens_wallet 
    SET amount = amount + '$amount' 
    WHERE member_id = '$member_id'
");


/* ✅ 2. MEMBER KA PLAN CHECK KARO */
$memQ = mysqli_query($con,"SELECT plan_id, membership_start, membership_end FROM sens_members WHERE member_id='$member_id'");
$mem  = mysqli_fetch_assoc($memQ);

$plan_id = $mem['plan_id'];

/* ✅ 3. PLAN DETAILS */
$planQ = mysqli_query($con,"SELECT * FROM sens_plans WHERE plan_id='$plan_id'");
$plan  = mysqli_fetch_assoc($planQ);

$duration = $plan['duration_days'];   // 365 OR NULL (lifetime)

/* ✅ 4. MEMBERSHIP UPDATE LOGIC */
if($duration != NULL){  
    // ✅ YEARLY OR MULTI YEAR PLAN

    if(empty($mem['membership_start'])){
        $start = $date;
    }else{
        $start = $mem['membership_start'];
    }

    // ✅ CURRENT END DATE SE AAGE BADHAO
    $end = date("Y-m-d", strtotime($start . " + $duration days"));

    mysqli_query($con, "
      UPDATE sens_members 
      SET membership_start='$start',
          membership_end='$end'
      WHERE member_id='$member_id'
    ");

}else{
    // ✅ LIFETIME PLAN CASE
    mysqli_query($con, "
      UPDATE sens_members 
      SET membership_start='$date',
          membership_end=NULL
      WHERE member_id='$member_id'
    ");
}

/* ✅ 5. REQUEST STATUS APPROVE (AGAR PEHLI PAYMENT H) */
mysqli_query($con, "
UPDATE sens_requests 
SET status='approved', approved_date=NOW()
WHERE member_id='$member_id'
");


/* ✅ 6. SUCCESS RESPONSE */
echo "
<div class='alert alert-success'>
✅ Payment Added Successfully <br>
Member ID: $member_id <br>
Paid Amount: ₹$amount <br>
For Year: $year
</div>
";

header("location:admin-payments.php?status=1");
?>

