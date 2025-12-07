<?php
include("connectdb.php");

$member_id   = $_POST['member_id'];
$bill_amount = $_POST['bill_amount'];
$purpose     = $_POST['purpose'];

// ✅ CURRENT DATE + TIME AUTO
$bill_date = date("Y-m-d H:i:s");

/* ✅ INSERT INTO BILLS */
$insert = mysqli_query($con, "
    INSERT INTO sens_bills (member_id, bill_date, bill_amount, bill_purpose)
    VALUES ('$member_id', '$bill_date', '$bill_amount', '$purpose')
");

if($insert){

    // ✅ ADD BILL AMOUNT TO MEMBER BALANCE
    mysqli_query($con, "
        UPDATE sens_members 
        SET balance_amount = balance_amount + $bill_amount
        WHERE member_id = '$member_id'
    ");

    echo "<script>
            alert('Bill Saved With Current Time ✅');
            window.history.back();
          </script>";

}else{
    echo "<script>
            alert('Error Saving Bill ❌');
            window.history.back();
          </script>";
}
?>
