<?php
include("connectdb.php");

$id = $_POST["id"];

$q = mysqli_query($con,"
    DELETE FROM sens_required 
    WHERE require_id='$id'
");

echo ($q ? "success" : "error");
