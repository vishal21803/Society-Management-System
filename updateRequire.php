<?php
include("connectdb.php");

$id = $_POST["require_id"];
$type = $_POST["require_type"];
$desc = $_POST["require_desc"];

$q = mysqli_query($con,"
    UPDATE sens_required SET 
        require_type='$type',
        require_desc='$desc'
    WHERE require_id='$id'
");

echo ($q ? "success" : "error");
