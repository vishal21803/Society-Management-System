<?php
include("connectdb.php");

$id = $_POST['user_id'];

mysqli_query($con,"UPDATE users SET 
email='{$_POST['email']}',
name='{$_POST['uname']}'
WHERE id='$id'");

mysqli_query($con,"UPDATE members SET 
fullname='{$_POST['fullname']}',
dob='{$_POST['dob']}',
gender='{$_POST['gender']}',
zone_id='{$_POST['zone']}',
city_id='{$_POST['city']}',
address='{$_POST['address']}'
WHERE user_id='$id'");

echo "<div class='alert alert-success'>✅ Profile Updated Successfully</div>";
?>
