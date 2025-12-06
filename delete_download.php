<?php
include 'connectdb.php';

$id = $_GET['id'];

// get file name
$res = mysqli_query($con, "SELECT file_name FROM downloads WHERE id=$id");
$row = mysqli_fetch_assoc($res);

unlink("upload/" . $row['file_name']); // delete file

mysqli_query($con, "DELETE FROM downloads WHERE id=$id");

echo "<script>alert('Deleted'); window.location='datatTableDownload.php';</script>";
?>
