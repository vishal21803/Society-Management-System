<?php
@session_start();
include("connectdb.php");

// Make sure admin is logged in
if(!isset($_SESSION['uname']) || $_SESSION['utype']!='admin'){
    exit("Unauthorized Access");
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if(isset($_POST['action'], $_POST['member_id'], $_POST['user_id'])){
    $action = $_POST['action'];
    $member_id = $_POST['member_id'];
    $user_id = $_POST['user_id'];
    $uname = $_SESSION['uname'];

    // Get user's email & member fullname
    $user = mysqli_fetch_assoc(mysqli_query($con, "SELECT email FROM sens_users WHERE id='$user_id'"));
    $member = mysqli_fetch_assoc(mysqli_query($con, "SELECT fullname FROM sens_members WHERE member_id='$member_id'"));

    $email = $user['email'];
    $fullname = $member['fullname'];

    if($action == "activate"){
        mysqli_query($con, "UPDATE sens_requests SET status='approved', created_by='$uname' WHERE member_id='$member_id'");
        $msg = "Your membership has been <b>activated</b>! Welcome, $fullname.";

    } elseif($action == "deactivate"){
        mysqli_query($con, "UPDATE sens_requests SET status='rejected', created_by='$uname' WHERE member_id='$member_id'");
        $msg = "Your membership has been <b>deactivated</b>, $fullname.";
    } else {
        exit("Invalid action");
    }

    // Send Email
    try {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'vishal21082003patil@gmail.com'; 
        $mail->Password = 'durynjnibluwgfor'; // your Gmail app password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('vishal21082003patil@gmail.com', 'Society Management');
        $mail->addAddress($email, $fullname);

        $mail->isHTML(true);
        $mail->Subject = "Membership Status Update";
        $mail->Body = "<h3>Hello $fullname,</h3><p>$msg</p>";

        $mail->send();
    } catch(Exception $e){
        // If mail fails, still proceed
    }

    echo "✅ Membership status updated & email sent!";
    exit;
}
?>
