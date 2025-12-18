<?php
include("connectdb.php");

$id = $_POST["id"];

$q = mysqli_query($con,"
    DELETE FROM sens_services 
    WHERE service_id='$id'
");

echo ($q ? "success" : "error");
