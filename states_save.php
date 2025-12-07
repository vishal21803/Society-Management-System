<?php
include "connectdb.php";

if(isset($_POST['state_name'])){
    $name = $_POST['state_name'];
    $res = mysqli_query($con,"INSERT INTO sens_states (state_name, created_at) VALUES ('$name', NOW())");
    if($res){
        echo "<span style='color:green'>State added successfully!</span>";
    } else {
        echo "<span style='color:red'>Error: ".mysqli_error($con)."</span>";
    }
}
