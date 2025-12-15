<?php
include("connectdb.php");
mysqli_query($con,"DELETE FROM sens_expenses WHERE expense_id=$_GET[id]");
header("location:manageExpenses.php");
