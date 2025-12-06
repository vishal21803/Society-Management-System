<?php
include("connectdb.php");

$id   = $_POST['id'];
$name = $_POST['name'];

$update = mysqli_query($con,"UPDATE cities SET city_name='$name' WHERE city_id='$id'");

if($update){
    echo "success";
}else{
    echo "error";
}
?>
