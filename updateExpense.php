<?php
include("connectdb.php");

mysqli_query($con,"
UPDATE sens_expenses SET
expense_type='$_POST[expense_type]',
expense_amount='$_POST[expense_amount]',
expense_date='$_POST[expense_date]',
expense_remark='$_POST[expense_remark]'
WHERE expense_id='$_POST[expense_id]'
");

header("location:manageExpenses.php?msg=updated");
