<?php
include("connectdb.php");

$zone_name = $_POST['zone_name'];

$q = mysqli_query($con, "SELECT zone_id FROM sens_zones WHERE zone_name='$zone_name'");
if(mysqli_num_rows($q) > 0){
    echo "exists";
    exit;
}

$ins = mysqli_query($con, "INSERT INTO sens_zones (zone_name, zstatus) VALUES ('$zone_name',1)");

echo $ins ? "success" : "error";
?>
