<?php
include("connectdb.php");

$title   = $_POST['title'];
$desc    = $_POST['description'];
$date    = $_POST['news_date'];
$status  = $_POST['status'];

/* ================= VISIBILITY LOGIC ================= */
$toshow_type = $_POST['toshow_type'];   // all | zone | city | member
$toshow_id   = NULL;

if($toshow_type == "zone"){
    $toshow_id = $_POST['toshow_zone'];
}
elseif($toshow_type == "city"){
    $toshow_id = $_POST['toshow_city'];
}
elseif($toshow_type == "member"){
    $toshow_id = $_POST['toshow_member'];
}

/* ================= IMAGE UPLOAD ================= */
$img    = $_FILES['news_img']['name'];
$tmp    = $_FILES['news_img']['tmp_name'];

$imgName = time()."_".$img;
move_uploaded_file($tmp, "upload/news/".$imgName);

/* ================= INSERT QUERY ================= */
$sql = "INSERT INTO news 
(title, description, news_date, status, news_img, toshow_type, toshow_id, created_at)
VALUES
('$title', '$desc', '$date', '$status', '$imgName', '$toshow_type', '$toshow_id', NOW())";

if(mysqli_query($con,$sql)){
    echo "<div class='alert alert-success'>✅ News Added Successfully</div>";
}else{
    echo "<div class='alert alert-danger'>❌ Error While Saving News</div>";
}
?>
