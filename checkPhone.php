<?php
include("connectdb.php");

$phone = $_POST['phone'];

$q = mysqli_query($con, "SELECT * FROM sens_members WHERE phone='$phone'");

echo mysqli_num_rows($q) > 0 ? "exists" : "ok";
?>
