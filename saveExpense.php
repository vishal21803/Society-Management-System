<?php @session_start();
include("connectdb.php");
$uname=$_SESSION['uname'];

$type   = $_POST['expense_type'];
$amount = $_POST['expense_amount'];
$date   = $_POST['expense_date'];
$remark = $_POST['expense_remark'];

$q = mysqli_query($con,"
INSERT INTO sens_expenses
(expense_type, expense_amount, expense_date, expense_remark,created_at,created_by)
VALUES
('$type','$amount','$date','$remark',NOW(),'$uname')
");

if($q){
    echo "success";
}else{
    echo "error";
}
