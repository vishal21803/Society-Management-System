<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

include("connectdb.php");   // DB connection

$email = $_POST['email'] ?? '';

if($email == ''){
    echo "❌ Email required";
    exit;
}

/* 🔍 CHECK USER */
$q = mysqli_query($con,"SELECT name,password FROM sens_users WHERE email='$email'");

if(mysqli_num_rows($q) == 0){
    echo "❌ Email not registered";
    exit;
}

$row = mysqli_fetch_assoc($q);
$name = $row['name'];
$password = $row['password'];   // ⚠️ Plain password (as you requested)

/* 📧 SEND EMAIL */
$mail = new PHPMailer(true);

try {
    // SMTP SETTINGS
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;

    $mail->Username   = 'vishal21082003patil@gmail.com';
    $mail->Password   = 'durynjnibluwgfor'; // 👈 app password

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // SENDER & RECEIVER
    $mail->setFrom('vishal21082003patil@gmail.com', 'Society Management');
    $mail->addAddress($email, $name);

    // EMAIL CONTENT
    $mail->isHTML(true);
    $mail->Subject = 'Your Login Password - Society Management';
    $mail->Body    = "
        <div style='font-family:Arial;'>
            <h3>Hello $name 👋</h3>
            <p>Your login password is:</p>
            <h2 style='color:#e74c3c;'>$password</h2>
            <p>Please keep it confidential.</p>
            <br>
            <small>Society Management Team</small>
        </div>
    ";

    $mail->send();
    echo "✅ Password sent to your email successfully";

} catch (Exception $e) {
    echo "❌ Mail Error: {$mail->ErrorInfo}";
}
?>
