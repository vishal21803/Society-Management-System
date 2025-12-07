<?php
include("connectdb.php");

$zone_id = $_POST['zone_id'];

$update = mysqli_query($con,"UPDATE sens_zones SET zstatus = 1 WHERE zone_id = '$zone_id'");

if($update){
    echo "✅ Zone activated Successfully";
}else{
    echo "❌ Failed to activate Zone";
}
?>
