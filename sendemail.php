<?php
// Include PHPMailer files
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get reCAPTCHA response
    $recaptchaResponse = $_POST['g-recaptcha-response'];

    // Your secret key
    $secretKey = ''; // Replace with your actual secret key

    // Verify the reCAPTCHA response
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$recaptchaResponse}");
    $responseKeys = json_decode($response, true);

    if (intval($responseKeys["success"]) !== 1) {
        // Handle the error if reCAPTCHA validation fails
        echo "<script>alert('reCAPTCHA validation failed. Please try again.'); window.location.href = 'index.html';</script>";
        exit;
    }

    // Get form input values
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $company = htmlspecialchars($_POST['company']);
    $message = htmlspecialchars($_POST['message']);

    // Set the recipient email address
    $to = "info@mitrading.com.pk"; // Replace this with your email to receive messages

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'mail.mitrading.com.pk'; // Set the SMTP server to send through
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = 'sendmail@mitrading.com.pk'; // Your Gmail address
        $mail->Password = ''; // Your Gmail app password 
        $mail->SMTPSecure = 'tls'; // Enable TLS encryption
        $mail->Port = 587; // TCP port to connect to

        // Recipients
        $mail->setFrom($mail->Username, 'Your Name'); // Use your Gmail address as sender
        $mail->addAddress($to); // Add a recipient

        // Content
        $mail->isHTML(true);
        $mail->Subject = "New Contact Form Submission from $name";
        $mail->Body    = "<strong>Name:</strong> $name<br>
                          <strong>Email:</strong> $email<br>
                          <strong>Phone:</strong> $phone<br>
                          <strong>Company:</strong> $company<br>
                          <strong>Message:</strong> $message<br>";
        $mail->AltBody = "Name: $name\nEmail: $email\nPhone: $phone\nCompany: $company\nMessage: $message\n";

        $mail->send();
        echo "<script>alert('You will get a response shortly'); window.location.href = 'index.html';</script>";
    } catch (Exception $e) {
        echo "<script>alert('Failed to send email. Mailer Error: {$mail->ErrorInfo}'); window.location.href = 'index.html';</script>";
    }
} else {
    echo "<script>alert('Invalid request.'); window.location.href = 'index.html';</script>";
}
?>