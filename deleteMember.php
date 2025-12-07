<?php
include("connectdb.php");
$id = $_POST['id'];

$delete = mysqli_query($con,"DELETE FROM sens_members WHERE member_id='$id'");

echo $delete ? "success" : "error";
?>
