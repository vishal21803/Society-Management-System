<?php @session_start();
include("connectdb.php");
$uname=$_SESSION["uname"];
$zone_id = $_POST['zone_id'];

$update = mysqli_query($con,"UPDATE sens_zones SET zstatus = 1,created_by='$uname' WHERE zone_id = '$zone_id'");

if($update){
    echo "✅ Zone activated Successfully";
}else{
    echo "❌ Failed to activate Zone";
}
?>
