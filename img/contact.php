<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $mobile = htmlspecialchars($_POST['mobile']);
    $company = htmlspecialchars($_POST['company']);
    $service = htmlspecialchars($_POST['service']);
    $message = htmlspecialchars($_POST['message']);
    $terms = isset($_POST['terms']) ? 'Agreed' : 'Not Agreed';

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'digitalbrand.susanth@gmail.com'; // Your email address
        $mail->Password = 'auhxmbxwxnerqznq'; // Your app-specific password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
        $mail->Port = 587; // TCP port for TLS

        // Sender and recipient settings
        $mail->setFrom('digitalbrand.susanth@gmail.com', 'Penaka'); // Sender email and name
        $mail->addAddress('digitalbrand.susanth@gmail.com', 'Penaka'); // Recipient email

        // Email content
        $mail->isHTML(true);
        $mail->Subject = "New Contact Form Submission";
        $mail->Body = "
            <h2>Contact Form Details</h2>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Mobile:</strong> $mobile</p>
            <p><strong>Company:</strong> $company</p>
            <p><strong>Service:</strong> $service</p>
            <p><strong>Message:</strong> $message</p>
            <p><strong>Terms Accepted:</strong> $terms</p>
        ";

        // Send email
        $mail->send();
        echo "<script>alert('Your message has been sent successfully!'); window.location.href='thankyou.html';</script>";
    } catch (Exception $e) {
        echo "<script>alert('Message could not be sent. Error: {$mail->ErrorInfo}');</script>";
    }
}
?>
