<?php
include("connectdb.php");

if(isset($_POST['id'])){
    $id = $_POST['id'];

        $delete = mysqli_query($con,"DELETE FROM sens_gallery WHERE gallery_id='$id'");
        if($delete){
            echo "success";
        } else {
            echo "error";
        }
    } 
else {
    echo "error";
}
?>
