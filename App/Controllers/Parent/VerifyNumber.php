<?php

namespace Controller;

defined('ROOTPATH') or exit('Access denied');

class VerifyNumber
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

        $Number = $_GET['number'] ?? null;
        if ($Number) {
            $data['Number'] = $Number;
        } else {
            $data['Number'] = '';
        }
        $session->set('NUMBER', $Number);

        // $SMSModal = new \core\SMS;
        // $SMSModal->sendSMS($Number, '+94714810928', "Your verification code is: $otp");

        $this->view('Parent/VerifyNumber', $data);
    }

    public function verify(){
        $session = new \Core\Session;
         
        $requestData = json_decode(file_get_contents("php://input"), true);
        $enteredOtp = $requestData['otp'];
        $session = new \Core\Session;
        $storedOtp = $session->get('OTP');

        if ($enteredOtp == $storedOtp) {

            $Number = $session->get('NUMBER');

            echo json_encode(['success' => true]);
            $session->unset('OTP');
            $session->unset('NUMBER');
            $UserID = $session->get("USERID");
    
            $ParentModal = new \Modal\ParentUser;
            $ParentModal->update(['UserID' => $UserID],['Phone_Number' => $Number]);

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
