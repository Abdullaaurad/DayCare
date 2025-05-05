<?php

// Create an instance of the Mailer class
$mailer = new \core\Mailer();

// Send a test email
$to = 'abdullaaurad@gmail.com'; // Replace with the recipient's email address
$subject = 'Test Email';
$body = '<h1>This is a test email</h1><p>Sent using PHPMailer with SMTP configuration.</p>';
$from = 'auradabdulla@gmail.com'; // Replace with your sender email
$fromName = 'Aura Test';

if ($mailer->send($to, $subject, $body, $from, $fromName)) {
    echo "Email sent successfully!";
} else {
    echo "Failed to send email.";
}
