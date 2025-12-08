<?php
@session_start();
include("connectdb.php");
$uname=$_SESSION["uname"];

$state_name = $_POST["state_name"];

mysqli_query($con, "INSERT INTO sens_states (state_name,created_by) VALUES ('$state_name','$uname')");

header("location:adminDashboard.php?msg=state_added");
?>
