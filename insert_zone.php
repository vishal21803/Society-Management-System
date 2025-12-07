<?php
include("db_connect.php");


    $zone_name = $_POST['zone_name'];
    $state_id  = $_POST['state_id'];

    mysqli_query( $con,"INSERT INTO sens_zones(name, state_id) VALUES('$zone_name', '$state_id')");
      header("location:adminDashboard.php?msg=zone_added");

    

?>
