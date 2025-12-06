<?php
include("connectdb.php");

$gallery_id = $_POST['gallery_id'];
$title      = $_POST['title'];
$desc       = $_POST['description'];
$visibility = $_POST['visibility'];
$zone_id    = $_POST['zone_id'] ?? '';
$city_id    = $_POST['city_id'] ?? '';
$member_id  = $_POST['member_id'] ?? '';

/* ============================
   IMAGE UPLOAD (OPTIONAL)
============================ */
if(!empty($_FILES['image']['name'])){
    
    $filename = rand(1000,9999)."_".$_FILES['image']['name'];
    $tmpname  = $_FILES['image']['tmp_name'];

    move_uploaded_file($tmpname, "upload/gallery/".$filename);

    $update = mysqli_query($con,"UPDATE gallery SET 
        title='$title',
        description='$desc',
        visibility_type='$visibility',
        zone_id='$zone_id',
        city_id='$city_id',
        member_id='$member_id',
        image='$filename'
        WHERE gallery_id='$gallery_id'
    ");

}else{

    $update = mysqli_query($con,"UPDATE gallery SET 
        title='$title',
        description='$desc',
        visibility_type='$visibility',
        zone_id='$zone_id',
        city_id='$city_id',
        member_id='$member_id'
        WHERE gallery_id='$gallery_id'
    ");
}

/* ============================
   RESPONSE
============================ */
if($update){
    echo "<span class='text-success fw-bold'>✅ Gallery Updated Successfully</span>";
}else{
    echo "<span class='text-danger fw-bold'>❌ Update Failed</span>";
}
?>
