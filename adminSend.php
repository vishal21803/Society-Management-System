<?php
@session_start();
include("connectdb.php");

if(isset($_POST['send'])){
    $sender_id   = $_SESSION['uid']; // admin id
    $sender_type = 'admin';

    $receiver_id   = $_REQUEST['id']; // from URL
    $receiver_type = 'user';

    $subject = mysqli_real_escape_string($con,$_POST['subject']);
    $message = mysqli_real_escape_string($con,$_POST['message']);

    mysqli_query($con,"INSERT INTO sens_messages 
    (sender_id,sender_type,receiver_id,receiver_type,subject,message)
    VALUES 
    ('$sender_id','$sender_type','$receiver_id','$receiver_type','$subject','$message')");

    header("Location: adminMessages.php");
}
?>
