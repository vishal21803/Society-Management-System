<?php 
@session_start();
include 'connectdb.php';

$uname = $_SESSION["uname"];

$topic = $_POST['topic'];
$remark = $_POST['remark'];
$type = $_POST['type'];

$target_dir = "upload/";

if(isset($_FILES["file"]) && $_FILES["file"]["error"] == 0){

    $file_name = time() . "_" . basename($_FILES["file"]["name"]);
    $target_file = $target_dir . $file_name;

    if(move_uploaded_file($_FILES["file"]["tmp_name"], $target_file))
    {
        $sql = "INSERT INTO sens_downloads (topic, remark, file_name, downshow, created_by)
                VALUES ('$topic', '$remark', '$file_name', '$type', '$uname')";
                
        mysqli_query($con, $sql);

        echo "<script>alert('File Uploaded'); window.location='datatTableDownload.php';</script>";
    }
    else{
        echo "Error uploading file!";
    }

}else{
    echo "No file selected or upload error!";
}
?>
