<?php
include("connectdb.php");

if(isset($_POST['id'])){

    $id       = $_POST['id'];
    $name     = $_POST['name'];
    $gender   = $_POST['gender'];
    $post     = $_POST['post'];
    $priority = $_POST['priority'];   // ✅ ADDED
    $duration = $_POST['duration'];   // ✅ ADDED
    $address  = $_POST['address'];
    $zone     = $_POST['zone'];
    $city     = $_POST['city'];

    $q = mysqli_query($con,"
        UPDATE sens_past_commity SET
        comi_name     = '$name',
        comi_gender   = '$gender',
        comi_post     = '$post',
        comi_priority = '$priority',
        comi_duration = '$duration',
        comi_address  = '$address',
        comi_zone     = '$zone',
        comi_city     = '$city'
        WHERE comi_id = '$id'
    ");

    if($q){
        echo "success";
    }else{
        echo "failed: " . mysqli_error($con);   // ✅ SHOW ERROR
    }
}
?>
