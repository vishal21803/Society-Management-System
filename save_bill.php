<?php @session_start();
include("connectdb.php");
date_default_timezone_set("Asia/Kolkata"); // ⭐ add this line

$uname=$_SESSION["uname"];

$member_id   = $_POST['member_id'];
$bill_amount = $_POST['bill_amount'];
$purpose     = $_POST['purpose'];
$type        = $_POST['type'];
$bdate       = $_POST['bill_date'];   // user selected date

// ⏳ append CURRENT TIME with user date
$time       = date("H:i:s");
$bill_date  = $bdate . " " . $time;

/* INSERT */
$insert = mysqli_query($con, "
    INSERT INTO sens_bills 
    (member_id, bill_date, bill_amount, bill_purpose, created_by, bill_type,bdate)
    VALUES 
    ('$member_id', NOW(), '$bill_amount', '$purpose', '$uname', '$type','$bill_date')
");

if($insert){

    mysqli_query($con, "
        UPDATE sens_members 
        SET balance_amount = balance_amount + $bill_amount
        WHERE member_id = '$member_id'
    ");

    echo "<script>
            alert('Bill Saved With User Date + Current Time 👍');
            window.history.back();
          </script>";

}else{

    echo "<script>
            alert('Error Saving Bill ❌');
            window.history.back();
          </script>";

}
?>
