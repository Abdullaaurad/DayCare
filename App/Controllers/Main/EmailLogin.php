<?php

namespace Controller;

defined('ROOTPATH') or exit('Access denied');

class EmailLogin
{
    use MainController;

    public function index($data = null)
    {
        $otp = $this->generateOTP();

        $session = new \Core\Session;
        $session->set('OTP', $otp);

        $Email = $session->get('VERIFIED_EMAIL');
        $session->set('EMAIL', $Email);
        $data['Email'] = $Email;
        $MailerModal = new \core\Mailer;

        $body = '
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>KiddoVille Login Request</title>
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
                        <h2>Login Request</h2>
                    </div>

                    <div class="content">
                        <p class="greeting">Hi there,</p>

                        <div class="message">
                            <p>We received a request to log in to your <strong>KiddoVille</strong> account using your email.</p>
                            <p>To proceed with logging in, please use the following One-Time Password (OTP):</p>
                        </div>

                        <div class="otp-box">' . htmlspecialchars($otp) . '</div>

                        <p class="expiration">This code will expire in 10 minutes.</p>

                        <div class="instructions">
                            <h3>How to login:</h3>
                            <ul>
                                <li>Enter the 6-digit code shown above on the login page</li>
                                <li>If you successfully log in, you will be able to access your account and all KiddoVille features</li>
                                <li>This step is to ensure the security of your account</li>
                            </ul>
                        </div>

                        <div class="security-notice">
                            <p><strong>Security Notice:</strong> If you did not request this login or create a KiddoVille account, please disregard this email and contact our security team immediately at <a href="mailto:security@kiddoville.com">security@kiddoville.com</a>.</p>
                        </div>

                        <div class="support">
                            <p>Need help? Our support team is always here to assist you!</p>
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
                        <p>Our <a href="#">Privacy Policy</a> • <a href="#">Terms of Service</a></p>
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
            'Email Verification - OTP Code', // Subject
            $body, // HTML body // TO
        );

        $this->view('main/EmailLogin', $data);
    }

    public function verify(){
        $requestData = json_decode(file_get_contents("php://input"), true);
        $enteredOtp = $requestData['otp'];
        $session = new \Core\Session;
        $storedOtp = $session->get('OTP');

        if ($enteredOtp == $storedOtp) {
            echo json_encode(['success' => true]);
            $session->unset('OTP');
            $session->unset('VERIFIED_EMAIL');

            $Email = $session->get('EMAIL');
            $found = false;
    
            $roles = [
                ['model' => \Modal\ParentUser::class, 'field' => 'Email'],
                ['model' => \Modal\Teacher::class, 'field' => 'Email'],
                ['model' => \Modal\Maid::class, 'field' => 'Email'],
                ['model' => \Modal\Receptionist::class, 'field' => 'Email'],
                ['model' => \Modal\Doctor::class, 'field' => 'Email'],
                ['model' => \Modal\Manager::class, 'field' => 'Email']
            ];
    
            foreach ($roles as $role) {
                $modal = new $role['model'];
                $result = $modal->first([$role['field'] => $Email]);
    
                if ($result) {
                    $found = true;
                    $session->set('USERID', $result->UserID);

                    $response['success'] = true;
                    $response['message'] = 'Email found and verified successfully.';
                }
            }
    
            if (!$found) {
                $response['errors'][] = 'Email not found in the system.';
            }

        } else {
            echo json_encode(['success' => false, 'message' => 'The OTP you entered is incorrect.']);

        }
    }

    private function generateOTP($length = 4)
    {
        $otp = '';
        for ($i = 0; $i < $length; $i++) {
            $otp .= rand(0, 9);
        }
        return $otp;
    }
}
