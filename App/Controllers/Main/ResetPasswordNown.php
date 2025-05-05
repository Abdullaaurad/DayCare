<?php

    namespace Controller;

    defined('ROOTPATH') or exit('Access denied');

    class ResetPasswordNown{
        use MainController;
        public function index()
        {
            $session = new \Core\Session;
            $session->check_login();

            $this->view('Main/ResetPasswordNown');
        }

        public function changepassword()
        {
            defined('ROOTPATH') or define('ROOTPATH', __DIR__); // Define the root if not already defined
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            header('Content-Type: application/json');
            ini_set('display_errors', 1);
            error_reporting(E_ALL);

            $response = [
                'success' => true,
                'message' => '',
                'errors' => []
            ];

            // Handle AJAX request and set the child session
            $request = json_decode(file_get_contents('php://input'),true);
            if (true) {
                $old = $request['old'];
                $new = $request['new'];

                $session = new \Core\Session;
                $userid = $session->get('USERID');

                // Retrieve user data from the database
                $user = new \Modal\User;
                $result = $user->first(['UserID' => $userid]);

                // Validate old and new passwords
                $oldpassworderror = $this->validatePassword($old);
                $newpassworderror = $this->validatePassword($new);

                // Check if old password is correct
                if ($oldpassworderror === true) {
                    if (!checkpassword($old,$result->Password)) {
                        $oldpassworderror = 'Incorrect current password';
                    }
                }

                if ($oldpassworderror !== true) {
                    $response['errors'][] = $oldpassworderror;
                }
                if ($newpassworderror !== true) {
                    $response['errors'][] = $newpassworderror;
                }

                // If there are validation errors, return them
                if (empty($response['errors'])) { {
                    // If validation passes, update the password
                    try {
                        // Update the password in the database (change 'Password' field)
                        $user->update(["UserID" => $userid], ["Password" => hashpassword($new)]);

                        // Update sessions (optional)
                        $session->unset("Logged_In");

                        // All success actions, set response
                        $response['success'] = true;
                        $response['message'] = 'Password updated successfully. Redirecting to login...';
                    } catch (\Exception $e) {
                        show("catch block");
                        // Catch any unexpected errors and return them in the response
                        $response['errors'][] = 'An error occurred: ' . $e->getMessage();
                        echo json_encode($response);
                        exit;
                    }
                }
            } else {
                show("old or new password not set");
                // Missing parameters in request
                $response['errors'][] = 'Old and or new password missing in request';
            }

            // Send the response as JSON
            echo json_encode($response);
        }
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
