<?php
@session_start();
include("connectdb.php");

/* SECURITY CHECK */
if(!isset($_SESSION['uid']) || !isset($_POST['send'])){
    header("Location: index.php");
    exit;
}

$uname = $_SESSION["uname"];

$sender_id   = $_SESSION['uid'];
$sender_type = 'user';

$receiver_id = mysqli_real_escape_string($con, $_POST['receiver_id']);
$subject     = mysqli_real_escape_string($con, $_POST['subject']);
$message     = mysqli_real_escape_string($con, $_POST['message']);

/* 🔥 GET RECEIVER ROLE DYNAMICALLY */
$rq = mysqli_query($con,"
    SELECT role 
    FROM sens_users 
    WHERE id='$receiver_id'
");

if(mysqli_num_rows($rq) == 0){
    // invalid receiver
    header("Location: userMessages.php?error=invalid_user");
    exit;
}

$rdata = mysqli_fetch_assoc($rq);
$receiver_type = $rdata['role'];   // admin / accountant / etc.

/* 🔥 INSERT MESSAGE */
mysqli_query($con,"
    INSERT INTO sens_messages
    (sender_id, sender_type, receiver_id, receiver_type, subject, message, created_by, created_at)
    VALUES
    ('$sender_id', '$sender_type', '$receiver_id', '$receiver_type',
     '$subject', '$message', '$uname', NOW())
");

/* SUCCESS */
header("Location: userMessages.php?sent=1");
exit;
?>
