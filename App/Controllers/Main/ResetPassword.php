<?php

    namespace Controller;

    defined('ROOTPATH') or exit('Access denied');

    class ResetPassword{
        use MainController;
        public function index()
        {
            $session = new \Core\Session;
            $session->check_login();

            $this->view('Main/ResetPassword');
        }

        public function ChangePassword()
        {
            defined('ROOTPATH') or define('ROOTPATH', __DIR__); // Define the root if not already defined
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
        
            header('Content-Type: application/json');
            ini_set('display_errors', 1);
            error_reporting(E_ALL);
        
            $response = [
                'success' => false,
                'message' => '',
                'errors' => []
            ];
        
            // Handle AJAX request and set the child session
            $request = json_decode(file_get_contents('php://input'), true);
            
            // Check if both old and new passwords are provided
            if (isset($request['password'])) {
                $newPassword = $request['password'];
        
                $session = new \Core\Session;
                $userid = $session->get('USERID');
        
                // Retrieve user data from the database
                $user = new \Modal\User;
                $result = $user->first(['UserID' => $userid]);
        
                // Validate new password
                $passwordError = $this->validatePassword($newPassword);
                if (!checkpassword($newPassword, $result->Password)) {
                    $response['errors'] = 'The new password cannot be the same as the current password';
                }
        
                // If there are any password errors, add them to the response
                if (!empty($response['errors']) && $passwordError !== true) {
                    echo json_encode($response);
                    exit;
                }
                else{
                    $user->update(["UserID" => $userid], ["Password" => hashpassword($newPassword)]);
                    $session->unset("Logged_In");
                    $session->unset("USERID");
        
                    $response['success'] = true;
                    $response['message'] = 'Password updated successfully. Redirecting to login...';
                }
            } else {
                // Missing parameters in request
                $response['errors'][] = 'Old or new password not set in the request';
            }
        
            // Send the response as JSON
            echo json_encode($response);
        }        

        private function validatePassword($password)
        {
            // Regular expression to allow only alphanumeric characters (letters and digits)
            $validPasswordRegex = '/^[a-zA-Z0-9]+$/';
        
            // Check if the password is exactly 6 characters long
            if (strlen($password) !== 6) {
                return 'Password must be exactly 6 characters long';
            }
        
            // Check if the password contains only numbers and alphabets (no special characters)
            if (!preg_match($validPasswordRegex, $password)) {
                return 'Password can only contain numbers and letters';
            }
        
            // If both checks pass, return true indicating a valid password
            return true;
        }        
    }
?>
