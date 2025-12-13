<?php
@session_start();
include("connectdb.php");
$uname=$_SESSION["uname"];
// ✅ Collect Form Data
$name     = $_POST['name'];
$gender   = $_POST['gender'];
$post     = $_POST['post'];
$priority = $_POST['priority'];
$duration = $_POST['duration'];
$zone     = $_POST['zone'];
$city     = $_POST['city'];
$address  = $_POST['address'];


// ✅ Image Upload
// $img = $_FILES['img']['name'];
// $tmp = $_FILES['img']['tmp_name'];
// $imgName = time()."_".$img;
// $path = "upload/committee/".$imgName;
// move_uploaded_file($tmp, $path);


$default_avatar="default_person.png";
$img=$default_avatar;
if(!empty($_FILES['img']['name'])){
    $img=time() . "_" . $_FILES['img']['name'];
    $target="upload/committee/".$img;
    if(move_uploaded_file($_FILES['img']['tmp_name'],$target)){
        $img=$img;
    }
}

// ✅ Insert Query
$q = "INSERT INTO sens_past_commity 
(comi_name, comi_gender, comi_post, comi_priority, comi_duration, comi_zone, comi_city,comi_address,comi_img,created_by)
VALUES 
('$name','$gender','$post','$priority','$duration','$zone','$city','$address','$img','$uname')";

$res = mysqli_query($con, $q);

// ✅ Success / Error Message
if($res){
    echo "<script>alert('Committee Member Added Successfully'); window.location='addPastCommitte.php';</script>";
} else {
    echo "Insert Failed: " . mysqli_error($con);
}
?>
