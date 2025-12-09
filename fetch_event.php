<?php
include("connectdb.php");

$id = $_POST['id'];

$q = mysqli_query($con,"SELECT * FROM sens_events WHERE event_id='$id'");
$row = mysqli_fetch_assoc($q);

$data = [
    "event_id"      => $row['event_id'],
    "title"         => $row['title'],
    "description"   => $row['description'],
    "event_date"    => $row['event_date'],
    "event_time"    => $row['event_time'],
    "event_location"=> $row['event_location'],
    "event_status"  => $row['event_status'],
    "toshow_type"   => $row['toshow_type'],
    "link"          => $row['video_link'] // ⭐ YOUTUBE LINK
];

echo json_encode($data);
?>
