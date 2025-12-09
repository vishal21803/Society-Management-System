<?php
include("connectdb.php");

$email = $_POST['email'];

$q = mysqli_query($con, "SELECT id FROM sens_users WHERE email='$email' ");

if(mysqli_num_rows($q) > 0){
    echo "exists";
} else {
    echo "ok";
}
?>
