<?php
@session_start();
include("connectdb.php");

$uname=$_SESSION["uname"];

    $zone_name = $_POST['zone_name'];
    $state_id  = $_POST['state_id'];

    mysqli_query( $con,"INSERT INTO sens_zones(name, state_id,created_by) VALUES('$zone_name', '$state_id','$uname')");
      header("location:adminDashboard.php?msg=zone_added");

    

?>
