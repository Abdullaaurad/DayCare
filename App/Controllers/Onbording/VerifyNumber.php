<?php

namespace Controller;

defined('ROOTPATH') or exit('Access denied');

class VerifyNumber
{
    use MainController;

    public function index($data = null){
        $otp = $this->generateOTP();

        $session = new \Core\Session;
        $session->set('OTP', $otp);
        $UserID = $session->get("USERID");

        $Number = $session->get('NUMBER');
        $data['Number'] = $Number;

        // $SMSModal = new \core\SMS;
        // $SMSModal->sendSMS($Number, '+94714810928', "Your verification code is: $otp");

        $this->view('Onbording/VerifyNumber', $data);
    }

    public function verify(){
        $requestData = json_decode(file_get_contents("php://input"), true);
        $enteredOtp = $requestData['otp'];
        $session = new \Core\Session;
        $storedOtp = $session->get('OTP');

        if ($enteredOtp == $storedOtp) {

            $session->unset('OTP');
            $session->set("CONTACT_VARIFIED", true);

            echo json_encode(['success' => true]);
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
