<?php 
@session_start();
include("connectdb.php");

// Load PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$uname = $_SESSION['uname'];

if(isset($_POST['action'], $_POST['request_id'])){

    $action = $_POST['action'];
    $req_id = $_POST['request_id'];

    // ✅ FETCH REQUEST, MEMBER, AND USER EMAIL
    $q = mysqli_fetch_assoc(mysqli_query($con, "
        SELECT r.*, m.user_id, u.email, m.fullname 
        FROM sens_requests r
        JOIN sens_members m ON r.member_id = m.member_id
        JOIN sens_users u ON u.id = m.user_id
        WHERE r.request_id='$req_id'
    "));

    $member_id = $q['member_id'];
    $user_email = $q['email'];
    $user_name = $q['fullname'];

    // Initialize PHPMailer
    $mail = new PHPMailer(true);

    try {
        // SMTP SETTINGS
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'vishal21082003patil@gmail.com';
        $mail->Password   = 'durynjnibluwgfor'; // ← Replace with your app password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // SENDER
        $mail->setFrom('vishal21082003patil@gmail.com', 'Society Management');
        $mail->addAddress($user_email, $user_name); // Receiver email

        // EMAIL CONTENT
        $mail->isHTML(true);

        // ✅ APPROVE REQUEST
        if($action == "approve"){

            $start = date('Y-m-d');

            // Update membership start
            mysqli_query($con,"
                UPDATE sens_members 
                SET membership_start='$start'
                WHERE member_id='$member_id'
            ");

            // Update request status
            mysqli_query($con,"
                UPDATE sens_requests 
                SET status='approved', approved_date=NOW(),created_by='$uname'
                WHERE request_id='$req_id'
            ");

            // Prepare email content
            $mail->Subject = 'Membership Approved';
            $mail->Body = "
                <h3>Hello $user_name,</h3>
                <p>Your membership request has been <b>approved</b>!</p>
                <p>Welcome to our society.</p>
                <p>Regards,<br>Society Admin</p>
            ";

            $mail->send();

            echo "✅ Member Approved & Membership Activated! Email Sent ✔";
            exit;
        }

        // ❌ REJECT REQUEST
        if($action == "reject"){

            // Update request status
            mysqli_query($con,"
                UPDATE sens_requests 
                SET status='rejected', created_by='$uname'
                WHERE request_id='$req_id'
            ");

            // Prepare email content
            $mail->Subject = 'Membership Request Rejected';
            $mail->Body = "
                <h3>Hello $user_name,</h3>
                <p>We regret to inform you that your membership request has been <b>rejected</b>.</p>
                <p>Regards,<br>Society Admin</p>
            ";

            $mail->send();

            echo "❌ Member Request Rejected! Email Sent ✔";
            exit;
        }

    } catch (Exception $e) {
        // If email fails, still update DB
        echo "⚠️ Member action done but email failed: {$mail->ErrorInfo}";
        exit;
    }

}
?>
