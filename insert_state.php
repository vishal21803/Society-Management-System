<?php
include("db_connect.php");

$state_name = $_POST["state_name"];

mysqli_query($con, "INSERT INTO sens_states (state_name) VALUES ('$state_name')");

header("location:adminDashboard.php?msg=state_added");
?>
