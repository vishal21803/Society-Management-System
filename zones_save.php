<?php
include "connectdb.php";

if(isset($_POST['zone_name'])){
    $zone_name = $_POST['zone_name'];
    $res = mysqli_query($con,"INSERT INTO sens_zones (zone_name) VALUES ( '$zone_name')");
    if($res){
        echo "<span style='color:green'>Zone added successfully!</span>";
    } else {
        echo "<span style='color:red'>Error: ".mysqli_error($con)."</span>";
    }
}
