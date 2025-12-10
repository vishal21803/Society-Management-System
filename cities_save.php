<?php @session_start();
include "connectdb.php";
$uname=$_SESSION["uname"];

if(isset($_POST['zone_id']) && isset($_POST['city_name'])){
    $zone_id = $_POST['zone_id'];
    $city_name = $_POST['city_name'];
    $res = mysqli_query($con,"INSERT INTO sens_cities (zone_id, city_name,created_by) VALUES ('$zone_id', '$city_name','$uname')");
   
    echo $res ? "success" : "error";

}
