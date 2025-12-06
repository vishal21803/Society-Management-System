<?php
include("connectdb.php");

$id = $_POST['id'];

// ✅ STEP 1: Check cstatus first
$check = mysqli_query($con,"SELECT cstatus FROM cities WHERE city_id='$id'");
$row = mysqli_fetch_assoc($check);

if($row['cstatus'] == 1){

    echo "active";
    exit;
}

// ✅ STEP 2: If cstatus = 0 → Allow delete
$delete = mysqli_query($con,"DELETE FROM cities WHERE city_id='$id'");

if($delete){
    echo "success";
}else{
    echo "error";
}
?>
