<?php
include("connectdb.php");

if(isset($_POST['id'])){
    
    $id = $_POST['id'];

    $q = mysqli_query($con, "SELECT * FROM gallery WHERE gallery_id='$id'");
    $data = mysqli_fetch_assoc($q);

    echo json_encode($data);
}
?>
