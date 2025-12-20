<?php @session_start();
include("connectdb.php");
$uname=$_SESSION["uname"];

$title = $_POST['title'];
$desc  = $_POST['description'];
$type  = $_POST['visibility'];
$priority=$_POST['priority'];
$zone   = $_POST['zone_id'] ?? null;
$city   = $_POST['city_id'] ?? null;
$member = $_POST['member_id'] ?? null;
$show=$_POST['show_front'];

$img = $_FILES['image']['name'];
$tmp = $_FILES['image']['tmp_name'];
$imgName = time()."_".$img;
move_uploaded_file($tmp,"upload/gallery/".$imgName);

$q = "INSERT INTO sens_gallery 
(title, description, visibility_type, zone_id, city_id, member_id, image, created_at,created_by,priority,gallery_front)
VALUES
('$title','$desc','$type','$zone','$city','$member','$imgName',NOW(),'$uname','$priority','$show')";

if(mysqli_query($con,$q)){
    echo "<div class='alert alert-success'>✅ Gallery Image Added Successfully</div>";
}else{
    echo "<div class='alert alert-danger'>❌ Insert Failed</div>";
}
?>
