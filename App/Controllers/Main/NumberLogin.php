<?php

namespace Controller;

defined('ROOTPATH') or exit('Access denied');

class NumberLogin
{
    use MainController;
    public function index($data = null){
        $otp = $this->generateOTP();

        $session = new \Core\Session;
        $session->set('OTP', $otp);

        $Phone = $session->get('VERIFIED_PHONE');
        $data['Phone'] = $Phone;
        $data['OTP'] = $otp;

        $SMSModal = new \core\SMS;
        $SMSModal->sendSMS($Phone, '+94714810928', "Your verification code is: $otp");

        $this->view('main/NumberLogin', $data);
    }

    public function verify(){
        $requestData = json_decode(file_get_contents("php://input"), true);
        $enteredOtp = $requestData['otp'];
        $session = new \Core\Session;
        $storedOtp = $session->get('OTP');

        if ($enteredOtp == $storedOtp) {
            echo json_encode(['success' => true]);
            $session->unset('OTP');
            $session->unset('VERIFIED_PHONE');

            $Phone = $session->get('VERIFIED_PHONE');
            $found = false;
    
            $roles = [
                ['model' => \Modal\ParentUser::class, 'field' => 'Phone_Number'],
                ['model' => \Modal\Teacher::class, 'field' => 'Phone_Number'],
                ['model' => \Modal\Maid::class, 'field' => 'Phone_Number'],
                ['model' => \Modal\Receptionist::class, 'field' => 'Phone_Number'],
                ['model' => \Modal\Doctor::class, 'field' => 'Phone_Number'],
                ['model' => \Modal\Manager::class, 'field' => 'Phone_Number']
            ];
    
            foreach ($roles as $role) {
                $modal = new $role['model'];
                $result = $modal->first([$role['field'] => $Phone]);
    
                if ($result) {
                    $found = true;
                    $session->set('USERID', $result->UserID);

                    $response['success'] = true;
                    $response['message'] = 'Contact Number found and verified successfully.';
                }
            }
    
            if (!$found) {
                $response['errors'][] = 'Contact Number not found in the system.';
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

?>