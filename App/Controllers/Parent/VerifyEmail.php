<?php

namespace Controller;

defined('ROOTPATH') or exit('Access denied');

class VerifyEmail
{
    use MainController;

    public function index($data = null){
        $otp = $this->generateOTP();

        $session = new \Core\Session;
        $session = new \Core\Session;
         
        $session->set('OTP', $otp);
        $UserID = $session->get("USERID");

        $ParentModal = new \Modal\ParentUser;
        $Parent = $ParentModal->first(['UserID' => $UserID]);

        $Email = $_GET['email'] ?? null;
        if ($Email) {
            $data['Email'] = $Email;
        } else {
            $data['Email'] = '';
        }
        $session->set('EMAIL', $Email);
        $MailerModal = new \core\Mailer;

        $body = '
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>KiddoVille Email Verification</title>
                <style>
                    body {
                        margin: 0;
                        padding: 0;
                        background-color: #f5f7fa;
                        font-family: \'Poppins\', Arial, sans-serif;
                    }

                    .email-container {
                        max-width: 600px;
                        margin: 20px auto;
                        border: 1px solid #e0e0e0;
                        border-radius: 12px;
                        overflow: hidden;
                        background-color: #ffffff;
                        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
                    }

                    .header {
                        background-color: #f9f9ff;
                        padding: 25px 0;
                        text-align: center;
                        border-bottom: 1px solid #eaeaea;
                    }

                    .header img {
                        height: 60px;
                        margin-bottom: 15px;
                    }

                    .header h2 {
                        margin: 0;
                        color: #2c3e50;
                        font-weight: 600;
                        font-size: 22px;
                    }

                    .content {
                        padding: 30px 40px;
                        color: #4a4a4a;
                    }

                    .greeting {
                        font-size: 18px;
                        font-weight: 500;
                        margin-bottom: 20px;
                    }

                    .message {
                        line-height: 1.6;
                        margin-bottom: 25px;
                    }

                    .otp-box {
                        font-size: 28px;
                        font-weight: 600;
                        color: #2c3e50;
                        background-color: #f8f9fa;
                        padding: 20px;
                        border-radius: 8px;
                        text-align: center;
                        letter-spacing: 10px;
                        margin: 25px 0;
                        border: 1px dashed #d1d9e6;
                    }

                    .expiration {
                        color: #e74c3c;
                        font-weight: 500;
                        text-align: center;
                        margin: 20px 0;
                    }

                    .instructions {
                        background-color: #f9fbfd;
                        padding: 15px 20px;
                        border-radius: 8px;
                        margin-bottom: 25px;
                        border-left: 4px solid #3498db;
                    }

                    .instructions h3 {
                        margin-top: 0;
                        color: #3498db;
                        font-size: 16px;
                    }

                    .instructions ul {
                        margin-bottom: 0;
                        padding-left: 20px;
                    }

                    .instructions li {
                        margin-bottom: 8px;
                    }

                    .security-notice {
                        font-size: 14px;
                        background-color: #fff8f8;
                        padding: 15px;
                        border-radius: 8px;
                        border-left: 4px solid #ff9800;
                        margin-bottom: 25px;
                    }

                    .support {
                        text-align: center;
                        margin: 30px 0 15px;
                    }

                    .support-button {
                        display: inline-block;
                        padding: 10px 20px;
                        background-color: #3498db;
                        color: white;
                        text-decoration: none;
                        border-radius: 6px;
                        font-weight: 500;
                        margin-top: 10px;
                    }

                    .divider {
                        height: 1px;
                        background-color: #eaeaea;
                        margin: 25px 0;
                    }

                    .social-links {
                        text-align: center;
                        padding: 0 0 15px;
                    }

                    .social-link {
                        display: inline-block;
                        margin: 0 8px;
                        color: #95a5a6;
                        text-decoration: none;
                        font-size: 14px;
                    }

                    .footer {
                        background-color: #f9f9ff;
                        padding: 20px;
                        text-align: center;
                        font-size: 13px;
                        color: #95a5a6;
                        border-top: 1px solid #eaeaea;
                    }

                    .footer p {
                        margin: 5px 0;
                    }

                    .address {
                        margin-top: 15px;
                        font-size: 12px;
                    }
                </style>
            </head>
            <body>
                <div class="email-container">
                    <div class="header">
                        <img src="cid:kiddoLogo" alt="KiddoVille Logo">
                        <h2>Email Verification</h2>
                    </div>

                    <div class="content">
                        <p class="greeting">Hello, ' . htmlspecialchars($Parent->First_Name . ' ' . $Parent->Last_Name) . ',</p>

                        <div class="message">
                            <p>You\'re almost there! Please verify your email address to complete your email change request.</p>
                            <p>Use the verification code below to confirm your email:</p>
                        </div>

                        <div class="otp-box">' . htmlspecialchars($otp) . '</div>

                        <p class="expiration">This code is valid for 10 minutes.</p>

                        <div class="instructions">
                            <h3>Next steps:</h3>
                            <ul>
                                <li>Enter the 4-digit code on the email verification page</li>
                                <li>Once verified, you’ll be able to access your KiddoVille account</li>
                                <li>Keep this code secure — do not share it with others</li>
                            </ul>
                        </div>

                        <div class="security-notice">
                            <p><strong>Didn\'t request this?</strong> If you didn’t try to verify your email, you can safely ignore this message. If this wasn’t you, please reach out to <a href="mailto:support@kiddoville.com">support@kiddoville.com</a>.</p>
                        </div>

                        <div class="support">
                            <p>Need help or have questions?</p>
                            <a href="https://kiddoville.com/support" class="support-button">Contact Support</a>
                        </div>

                        <div class="divider"></div>

                        <div class="social-links">
                            <a href="https://facebook.com/kiddoville" class="social-link">Facebook</a> •
                            <a href="https://instagram.com/kiddoville" class="social-link">Instagram</a> •
                            <a href="https://twitter.com/kiddoville" class="social-link">Twitter</a> •
                            <a href="https://pinterest.com/kiddoville" class="social-link">Pinterest</a>
                        </div>
                    </div>

                    <div class="footer">
                        <p>&copy; ' . date("Y") . ' KiddoVille Inc. All rights reserved.</p>
                        <p><a href="#">Privacy Policy</a> • <a href="#">Terms of Service</a></p>
                        <div class="address">
                            KiddoVille Inc.,<br>
                            106/37 , Nawagampura, Stace Road, Colombo 14, Sri Lanka<br>
                            Phone: +94 71 481 0928<br>
                        </div>
                    </div>
                </div>
            </body>
            </html>';


        $MailerModal->send(
            $Email,
            'Email Verification - OTP Code',
            $body,
        );

        $this->view('Parent/VerifyEmail', $data);
    }

    public function verify(){
        $session = new \Core\Session;
         
        $requestData = json_decode(file_get_contents("php://input"), true);
        $enteredOtp = $requestData['otp'];
        $session = new \Core\Session;
        $storedOtp = $session->get('OTP');

        if ($enteredOtp == $storedOtp) {

            $Email = $session->get('EMAIL');

            echo json_encode(['success' => true]);
            $session->unset('OTP');
            $session->unset('EMAIL');
            $UserID = $session->get("USERID");
    
            $ParentModal = new \Modal\ParentUser;
            $ParentModal->update(['UserID' => $UserID],['Email' => $Email]);

        } else {
            echo json_encode(['success' => false, 'message' => 'The OTP you entered is incorrect.']);

        }
    }

    private function generateOTP($length = 4)
    {
        $session = new \Core\Session;
         
        $otp = '';
        for ($i = 0; $i < $length; $i++) {
            $otp .= rand(0, 9);
        }
        return $otp;
    }
}
