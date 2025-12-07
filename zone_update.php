<?php
include("connectdb.php");

$id   = $_POST['id'];
$name = $_POST['name'];

$update = mysqli_query($con,"UPDATE sens_zones SET zone_name='$name' WHERE zone_id='$id'");

if($update){
    echo "success";
}else{
    echo "error";
}
?>
