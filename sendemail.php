<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name     = $_POST['name'] ?? '';
    $email    = $_POST['email'] ?? '';
    $company  = $_POST['company'] ?? '';
    $message  = $_POST['message'] ?? '';
    $token    = $_POST['g-recaptcha-response'] ?? '';

    // reCAPTCHA verification
    $secretKey = ''; // SECRET KEY
    $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$token}");
    $captchaSuccess = json_decode($verify);

    if (!$captchaSuccess->success) {
        echo "captcha-failed";
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'mitrading.com.pk'; // Your mail host
        $mail->SMTPAuth   = true;
        $mail->Username   = 'sendmail@mitrading.com.pk'; 
        $mail->Password   = '';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        $mail->setFrom('sendmail@mitrading.com.pk', 'MI Trading');
        $mail->addAddress('ra.other2@gmail.com', 'Rayyan');

        $mail->isHTML(true);
        $mail->Subject = 'New Contact Form Submission';
        $mail->Body = "
            <h3>New Message from Contact Form:</h3>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Company:</strong> $company</p>
            <p><strong>Message:</strong><br>$message</p>
        ";

        $mail->send();
        echo "success";
    } catch (Exception $e) {
        error_log("Mailer Error: " . $mail->ErrorInfo);
        echo "error";
    }
} else {
    echo "invalid";
}
?>
