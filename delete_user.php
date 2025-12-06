<?php
include("connectdb.php");

$id = $_POST['id'];

// mysqli_query($con, "DELETE FROM users WHERE id='$id'");
mysqli_query($con, "DELETE FROM members WHERE member_id='$id'");

echo "✅ User Deleted Successfully";
?>
