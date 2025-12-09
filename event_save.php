<?php @session_start();
include("connectdb.php");
$uname=$_SESSION["uname"];

$title   = $_POST['event_title'];
$desc    = $_POST['event_desc'];
$date    = $_POST['event_date'];
$time    = $_POST['event_time'];
$loc     = $_POST['event_location'];
$status  = $_POST['event_status'];
$link  = $_POST['link'];


$toshow_type = $_POST['toshow_type'];
$toshow_id = null;

if($toshow_type == "zone"){
    $toshow_id = $_POST['toshow_zone'];
}
elseif($toshow_type == "city"){
    $toshow_id = $_POST['toshow_city'];
}
elseif($toshow_type == "member"){
    $toshow_id = $_POST['toshow_member'];
}

/* IMAGE UPLOAD */
$img = $_FILES['event_img']['name'];
$tmp = $_FILES['event_img']['tmp_name'];
move_uploaded_file($tmp,"upload/events/".$img);

$sql = "INSERT INTO sens_events 
(title, description, event_date, event_time, event_location, event_status, event_img, toshow_type, toshow_id, created_at,created_by,video_link)
VALUES
('$title','$desc','$date','$time','$loc','$status','$img','$toshow_type','$toshow_id',NOW(),'$uname','$link')";

if(mysqli_query($con,$sql)){
    echo "success";
}else{
    echo "error";
}
?>
