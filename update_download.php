<?php
include 'connectdb.php';

$id = $_POST['id'];
$topic = $_POST['topic'];
$type=$_POST['type'];
$remark = $_POST['remark'];

if ($_FILES['file']['name'] != "") {

    // get old file
    $res = mysqli_query($con, "SELECT file_name FROM sens_downloads WHERE id=$id");
    $row = mysqli_fetch_assoc($res);
    unlink("upload/" . $row['file_name']);

    $new_file = time() . "_" . basename($_FILES["file"]["name"]);
    move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $new_file);

    $sql = "UPDATE sens_downloads SET topic='$topic', remark='$remark', file_name='$new_file',downshow='$type'
            WHERE id=$id";
} else {
    $sql = "UPDATE sens_downloads SET topic='$topic', remark='$remark',downshow='$type'
            WHERE id=$id";
}

mysqli_query($con, $sql);

echo "<script>alert('Updated'); window.location='datatTableDownload.php';</script>";
?>
