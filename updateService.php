<?php
include("connectdb.php");

$id = $_POST["service_id"];
$type = $_POST["service_type"];
$desc = $_POST["service_desc"];

$q = mysqli_query($con,"
    UPDATE sens_services SET 
        service_type='$type',
        service_desc='$desc'
    WHERE service_id='$id'
");

echo ($q ? "success" : "error");
