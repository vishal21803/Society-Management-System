<?php
include("connectdb.php");

$id = $_POST['gallery_id'];
$title = $_POST['title'];
$desc = $_POST['description'];
$visibility = $_POST['visibility_type'];
$priority=$_POST["priority"];
$zone = $_POST['zone_id'] ?? null;
$city = $_POST['city_id'] ?? null;
$member = $_POST['member_id'] ?? null;
$show=$_POST["gallery_front"];

if(!empty($_FILES['image']['name'])){
    $img = time().$_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], "upload/gallery/".$img);
    $imgSQL = ", image='$img'";
}else{
    $imgSQL = "";
}

$update = mysqli_query($con,"
    UPDATE sens_gallery SET 
    title='$title',
    description='$desc',
    priority='$priority',
    visibility_type='$visibility',
    zone_id='$zone',
    city_id='$city',
    gallery_front='$show',
    member_id='$member'
    $imgSQL
    WHERE gallery_id='$id'
");

if($update){
    echo "success";
}else{
    echo mysqli_error($con);
}
?>
