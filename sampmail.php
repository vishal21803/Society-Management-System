<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    // SMTP SETTINGS
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;

    $mail->Username   = 'vishal21082003patil@gmail.com';
    $mail->Password   = 'durynjnibluwgfor';  // ← yaha app password daalo

    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    // SENDER & RECEIVER
    $mail->setFrom('vishal21082003patil@gmail.com', 'Society Management');
    $mail->addAddress('123vishal18910@gmail.com'); // Jisko mail bhejna ho

    // EMAIL CONTENT
    $mail->isHTML(true);
    $mail->Subject = 'Test Email from Localhost';
    $mail->Body    = "
        <h2>Hello!</h2>
        This is a test email sent from <b>localhost (WAMP)</b>.
    ";

    $mail->send();
    echo "Mail Sent Successfully ✔";
} catch (Exception $e) {
    echo "Mail Failed ❌ Error: {$mail->ErrorInfo}";
}
?>


