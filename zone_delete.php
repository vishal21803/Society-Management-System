<?php
include("connectdb.php");

$id = $_POST['id'];

// ✅ STEP 1: Check zstatus first
$check = mysqli_query($con,"SELECT zstatus FROM sens_zones WHERE zone_id='$id'");
$row = mysqli_fetch_assoc($check);

if($row['zstatus'] == 1){
    // ❌ ACTIVE ZONE → DELETE BLOCKED
    echo "active";
    exit;
}

// ✅ STEP 2: If zstatus = 0 → Allow delete
$delete = mysqli_query($con,"DELETE FROM sens_zones WHERE zone_id='$id'");

if($delete){
    echo "success";
}else{
    echo "error";
}
?>
