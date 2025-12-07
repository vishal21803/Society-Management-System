<?php
include 'connectdb.php';   // your DB connection file

$topic = $_POST['topic'];
$remark = $_POST['remark'];
$type = $_POST['type'];


$target_dir = "upload/";
$file_name = time() . "_" . basename($_FILES["file"]["name"]);
$target_file = $target_dir . $file_name;

if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {

    $sql = "INSERT INTO sens_downloads (topic, remark, file_name,downshow) 
            VALUES ('$topic', '$remark', '$file_name','$type')";
    mysqli_query($con, $sql);

    echo "<script>alert('File Uploaded'); window.location='datatTableDownload.php';</script>";
} else {
    echo "Error uploading file!";
}
?>
