<?php

namespace Core;

defined('ROOTPATH') or exit('Access denied');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

class Mailer
{
    private $mailer;

    public function __construct()
    {
        $this->mailer = new PHPMailer(true);
        $this->setupSMTP();
    }

    private function setupSMTP()
    {
        $this->mailer->isSMTP();
        $this->mailer->Host = 'smtp.gmail.com';
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = 'kiddovilledaycare@gmail.com';  // Set your Gmail address
        $this->mailer->Password = 'evex yzrv heuv abtm'; // Use your app password here
        $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mailer->Port = 587;
    }

    public function send($to, $subject, $body, $fromName = 'KiddoVille')
    {
        try {
            $this->mailer->setFrom('kiddovilledaycare@gmail.com', $fromName);
            $this->mailer->addAddress($to);
    
            // Embed the logo image from your local path
            $this->mailer->AddEmbeddedImage(
                'C:/xampp/htdocs/KiddoVille-UI_UX/public/Assets/Images/logo_light-remove.png', // absolute server path
                'kiddoLogo' // CID name for referencing in HTML
            );
    
            $this->mailer->isHTML(true);
            $this->mailer->Subject = $subject;
            $this->mailer->Body = $body;
    
            $this->mailer->send();
            return true;
        } catch (\Exception $e) {
            error_log("Mailer Error: {$this->mailer->ErrorInfo}");
            return false;
        }
    }
    
}

?>