<?php
include("connectdb.php");

$id    = $_POST['news_id'];
$title = $_POST['title'];
$desc  = $_POST['description'];
$type  = $_POST['toshow_type'];
$tid   = $_POST['toshow_id'];
$date  = $_POST['news_date'];
$status= $_POST['status'];

if(!empty($_FILES['news_img']['name'])){
    $img = rand().$_FILES['news_img']['name'];
    move_uploaded_file($_FILES['news_img']['tmp_name'],"upload/news/".$img);

    $q = "UPDATE news SET 
        title='$title',
        description='$desc',
        toshow_type='$type',
        toshow_id='$tid',
        news_date='$date',
        status='$status',
        news_img='$img'
        WHERE news_id='$id'";
}
else{
    $q = "UPDATE news SET 
        title='$title',
        description='$desc',
        toshow_type='$type',
        toshow_id='$tid',
        news_date='$date',
        status='$status'
        WHERE news_id='$id'";
}

mysqli_query($con,$q);

echo "✅ News Updated Successfully";
?>
