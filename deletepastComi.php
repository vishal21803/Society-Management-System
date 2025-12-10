<?php
include("connectdb.php");

if(isset($_POST['id'])){

    $id = $_POST['id'];

    // OPTIONAL: Image delete bhi karna ho to
    $img = mysqli_fetch_assoc(mysqli_query($con,"
        SELECT comi_img FROM sens_commity WHERE comi_id='$id'
    "));

    if(!empty($img['comi_img'])){
        @unlink("upload/committee/".$img['comi_img']);
    }

    $q = mysqli_query($con,"DELETE FROM sens_past_commity WHERE comi_id='$id'");

    if($q){
        echo "success";
    }else{
        echo "failed";
    }
}
?>
