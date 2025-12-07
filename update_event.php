<?php
include("connectdb.php");

$id        = $_POST['id'];
$title     = $_POST['title'];
$desc      = $_POST['desc'];
$date      = $_POST['date'];
$time      = $_POST['time'];
$location  = $_POST['location'];
$status    = $_POST['status'];
$showType  = $_POST['showType'];

$q=mysqli_query($con,"UPDATE sens_events SET 
title='$title',
description='$desc',
event_date='$date',
event_time='$time',
event_location='$location',
event_status='$status',
toshow_type='$showType'
WHERE event_id='$id'");


if($q){
    echo "success";
}else{
    echo "error";
}
?>

