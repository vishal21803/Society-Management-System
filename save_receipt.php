<?php
include("connectdb.php");

$member_id      = $_POST['member_id'];
$receipt_amount = $_POST['receipt_amount'];
$purpose        = $_POST['purpose'];
$receipt_id     = $_POST['receipt_id'];

// ✅ CURRENT DATE + TIME AUTO
$receipt_date = date("Y-m-d H:i:s");

/* ✅ INSERT INTO RECEIPT */
$insert = mysqli_query($con, "
    INSERT INTO receipt (manualID, member_id, receipt_date, receipt_amount, purpose)
    VALUES ('$receipt_id', '$member_id', '$receipt_date', '$receipt_amount', '$purpose')
");

if($insert){

    // ✅ SUBTRACT RECEIPT AMOUNT FROM BALANCE
    mysqli_query($con, "
        UPDATE members 
        SET balance_amount = balance_amount - $receipt_amount
        WHERE member_id = '$member_id'
    ");

    echo "<script>
            alert('Receipt Saved With Current Time ✅');
            window.history.back();
          </script>";

}else{
    echo "<script>
            alert('Error Saving Receipt ❌');
            window.history.back();
          </script>";
}
?>
