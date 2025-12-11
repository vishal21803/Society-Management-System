<?php
include("connectdb.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id         = $_POST['event_id'];
    $title      = $_POST['title'];
    $status     = $_POST['event_status'];
    $date       = $_POST['event_date'];
    $time       = $_POST['event_time'];
    $location   = $_POST['event_location'];
    $link       = $_POST['youtube_link'];
    $desc       = $_POST['description'];
    $toshow     = $_POST['toshow_type'];
    $toshowid     = $_POST['toshow_id'];

    /* IMAGE UPLOAD CHECK */
    $img = $_FILES['event_img']['name'];
    $tmp = $_FILES['event_img']['tmp_name'];

    $imgName = time()."_".$img;


    if (!empty($img)) {
        // user uploaded new image
        move_uploaded_file($tmp, "upload/events/" . $imgName);
        $imgQuery = ", event_img = '$imgName'";   
    } else {
        // no new image uploaded → don't update image column
        $imgQuery = "";
    }

    $q = mysqli_query($con, "
        UPDATE sens_events SET
            title           = '$title',
            event_status    = '$status',
            event_date      = '$date',
            event_time      = '$time',
            event_location  = '$location',
            video_link      = '$link',
            description     = '$desc',
            toshow_type     = '$toshow'
            $imgQuery
        WHERE event_id = '$id'
    ");

    if ($q) {
        echo "<script>alert('Event Updated Successfully!'); window.location.href='manage_events.php';</script>";
    } else {
        echo "<script>alert('Failed to Update Event!'); history.back();</script>";
    }
}
?>
