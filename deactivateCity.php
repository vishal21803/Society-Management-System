<?php
include("connectdb.php");

$zone_id = $_POST['zone_id'];

$update = mysqli_query($con,"UPDATE cities SET cstatus = 0 WHERE city_id = '$zone_id'");

if($update){
    echo "✅ City Deactivated Successfully";
}else{
    echo "❌ Failed to Deactivate City";
}
?>
