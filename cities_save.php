<?php
include "connectdb.php";

if(isset($_POST['zone_id']) && isset($_POST['city_name'])){
    $zone_id = $_POST['zone_id'];
    $city_name = $_POST['city_name'];
    $res = mysqli_query($con,"INSERT INTO sens_cities (zone_id, city_name) VALUES ('$zone_id', '$city_name')");
    if($res){
        echo "<span style='color:green'>City added successfully!</span>";
    } else {
        echo "<span style='color:red'>Error: ".mysqli_error($con)."</span>";
    }
}
