<?php
include("connectdb.php");

$id     = $_POST['news_id'];
$title  = $_POST['title'];
$desc   = $_POST['description'];
$type   = $_POST['toshow_type'];
$tid    = $_POST['toshow_id'];   // may be empty
$date   = $_POST['news_date'];
$status = $_POST['status'];

// ✅ Base query
$q = "UPDATE news SET 
        title='$title',
        description='$desc',
        toshow_type='$type',
        news_date='$date',
        status='$status'";

// ✅ Sirf tabhi toshow_id update ho jab empty na ho
if(!empty($tid)){
    $q .= ", toshow_id='$tid'";
}

// ✅ Image upload agar aaye tabhi update ho
if(!empty($_FILES['news_img']['name'])){
    $img = rand().$_FILES['news_img']['name'];
    move_uploaded_file($_FILES['news_img']['tmp_name'], "upload/news/".$img);

    $q .= ", news_img='$img'";
}

// ✅ Last me WHERE condition
$q .= " WHERE news_id='$id'";

// ✅ Execute
mysqli_query($con, $q);

echo "✅ News Updated Successfully";
?>
