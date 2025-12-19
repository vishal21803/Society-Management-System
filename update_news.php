<?php
include("connectdb.php");

$id     = $_POST['news_id'];
$title  = $_POST['title'];
$desc   = $_POST['description'];
$type   = $_POST['toshow_type'];
$tid    = $_POST['toshow_id'] ?? 0;
$date   = $_POST['news_date'];
$status = $_POST['status'];
$time   = $_POST['news_time'];

// Start update query
$q = "UPDATE sens_news SET 
        title='$title',
        description='$desc',
        toshow_type='$type',
        news_date='$date',
        status='$status',
        toshow_id='$tid'";


// ⛔ only update if news_time is NOT blank
if(trim($time) != ""){
    $q .= ", news_time='$time'";
}


// ⛔ only update if file uploaded
if(!empty($_FILES['news_img']['name'])){
    $img = rand().$_FILES['news_img']['name'];
    move_uploaded_file($_FILES['news_img']['tmp_name'], "upload/news/".$img);
    $q .= ", news_img='$img'";
}

$q .= " WHERE news_id='$id'";

mysqli_query($con, $q);

echo "success";

?>
