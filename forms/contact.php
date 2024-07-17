<?php
// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader if you are using Composer
require 'D:/xampp/htdocs/PHPMailer/src/Exception.php';
require 'D:/xampp/htdocs/PHPMailer/src/PHPMailer.php';
require 'D:/xampp/htdocs/PHPMailer/src/SMTP.php';

// Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->SMTPDebug = 0; // Disable verbose debug output
    $mail->isSMTP(); // Send using SMTP
    $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
    $mail->SMTPAuth = true; // Enable SMTP authentication
    $mail->Username = 'rimmon342@gmail.com'; // SMTP username
    $mail->Password = 'hvkrasvugqykpvqz'; // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
    $mail->Port = 587; // TCP port to connect to

    // Recipients
    $mail->setFrom(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL), filter_var($_POST['name'], FILTER_SANITIZE_STRING)); // Sender Email and name
    $mail->addAddress('christrimmonflavin@gmail.com'); // Add a recipient email
    $mail->addReplyTo(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL), filter_var($_POST['name'], FILTER_SANITIZE_STRING));

    // Content
    $mail->isHTML(true); // Set email format to HTML
    $mail->Subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING); // Email subject
    $mail->Body = nl2br(htmlspecialchars($_POST['message'])); // Email body, convert newlines to <br> and escape HTML
    $mail->AltBody = htmlspecialchars($_POST['message']); // Plain text body

    $mail->send();
    echo 'Your message has been sent. Thank you!';
} catch (Exception $e) {
    echo 'error';
}
?>
