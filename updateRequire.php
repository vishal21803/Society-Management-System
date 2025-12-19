<?php
include("connectdb.php");

$id = $_POST["require_id"];
$type = $_POST["require_type"];
$desc = $_POST["require_desc"];
$date= $_POST["require_date"];


$q = mysqli_query($con,"
    UPDATE sens_required SET 
        require_type='$type',
        require_desc='$desc',
        require_date='$date'
    WHERE require_id='$id'
");

echo ($q ? "success" : "error");
