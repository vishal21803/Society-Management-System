<?php
include("connectdb.php");

if(isset($_POST['id'])){

    $id       = $_POST['id'];
    $name     = $_POST['name'];
    $gender   = $_POST['gender'];
    $post     = $_POST['post'];
    $priority = $_POST['priority'];
    $duration = $_POST['duration'];
    $address  = $_POST['address'];
    $zone     = $_POST['zone'];
    $city     = $_POST['city'];

    // Fetch current photo
    $oldPhoto = "";
    $get = mysqli_query($con, "SELECT comi_img FROM sens_commity WHERE comi_id='$id'");
    if ($r = mysqli_fetch_assoc($get)) {
        $oldPhoto = $r['comi_img'];
    }

    // File handling
    $newPhotoName = $oldPhoto; // default keep old

    if(isset($_FILES['photo']['name']) && $_FILES['photo']['name'] != ""){
        $tmp = $_FILES['photo']['tmp_name'];
        $ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
        $newPhotoName = "comi_" . time() . "." . $ext;

        // Save image
        move_uploaded_file($tmp, "upload/committee/" . $newPhotoName);

        // Delete old image if not default
        if($oldPhoto != "" && file_exists("upload/committee/" . $oldPhoto)){
            unlink("upload/committee/" . $oldPhoto);
        }
    }

    // Now update query
    $q = mysqli_query($con,"
        UPDATE sens_commity SET
        comi_name     = '$name',
        comi_gender   = '$gender',
        comi_post     = '$post',
        comi_priority = '$priority',
        comi_duration = '$duration',
        comi_address  = '$address',
        comi_zone     = '$zone',
        comi_city     = '$city',
        comi_img      = '$newPhotoName'
        WHERE comi_id = '$id'
    ");

    echo $q ? "success" : "failed: " . mysqli_error($con);
}
?>
