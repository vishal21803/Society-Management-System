<?php
@session_start();
include("connectdb.php");

if(isset($_POST['send'])){
    $sender_id   = $_SESSION['uid'];
    $sender_type = 'user';

    $receiver_id   = 1; // ✅ Admin ID fix (ya dynamic bana sakte hain)
    $receiver_type = 'admin';

    $subject = mysqli_real_escape_string($con,$_POST['subject']);
    $message = mysqli_real_escape_string($con,$_POST['message']);

    mysqli_query($con,"INSERT INTO sens_messages 
    (sender_id,sender_type,receiver_id,receiver_type,subject,message)
    VALUES 
    ('$sender_id','$sender_type','$receiver_id','$receiver_type','$subject','$message')");

    header("Location: userMessages.php");
}
?>
