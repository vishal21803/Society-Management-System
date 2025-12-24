<?php 
@session_start();
include("connectdb.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$uname = $_SESSION['uname'];

if(isset($_POST['action'], $_POST['request_id'])){

    $action = $_POST['action'];
    $req_id = $_POST['request_id'];

    // Fetch request + email
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


    // approve
    if($action == "approve"){

        $start = date('Y-m-d');

        mysqli_query($con,"
            UPDATE sens_members 
            SET membership_start='$start'
            WHERE member_id='$member_id'
        ");

        mysqli_query($con,"
            UPDATE sens_requests
            SET status='approved', approved_date=NOW(), created_by='$uname'
            WHERE request_id='$req_id'
        ");

        // only send mail if email exists
        if(!empty($user_email)){

            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'yourID@gmail.com';  // your Gmail ID
                $mail->Password   = '';  // your Gmail app Password
                $mail->SMTPSecure = 'tls';
                $mail->Port       = 587;

                $mail->setFrom('yourID@gmail.com', 'Society Management');
                $mail->addAddress($user_email, $user_name);

                $mail->isHTML(true);
                $mail->Subject = 'Membership Approved';
                $mail->Body = "
                    <h3>Hello $user_name,</h3>
                    <p>Your membership request has been <b>approved</b>!</p>
                ";

                $mail->send();

                echo "Approved + Email Sent ✔";
                exit;

            } catch (Exception $e) {}
        }

        echo "Approved ✔ (No Email Sent)";
        exit;
    }


    // reject
    if($action == "reject"){

        mysqli_query($con,"
            UPDATE sens_requests
            SET status='rejected', created_by='$uname'
            WHERE request_id='$req_id'
        ");

        if(!empty($user_email)){

            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'yourID@gmail.com';  // your Gmail ID
                $mail->Password   = '';  // your Gmail app Password
                $mail->SMTPSecure = 'tls';
                $mail->Port       = 587;

                $mail->setFrom('yourID@gmail.com', 'Society Management');
                $mail->addAddress($user_email, $user_name);

                $mail->isHTML(true);
                $mail->Subject = 'Membership Rejected';
                $mail->Body = "
                    <h3>Hello $user_name,</h3>
                    <p>Your membership request has been rejected.</p>
                ";

                $mail->send();

                echo "Rejected + Email Sent ✔";
                exit;

            } catch (Exception $e) {}
        }

        echo "Rejected ✔ (No Email Sent)";
        exit;
    }

}
?>
