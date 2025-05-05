<?php

namespace Controller;

defined('ROOTPATH') or exit('Access denied');

class ChangeUsername
{
    use MainController;
    public function index($data = null)
    {
        $session = new \Core\Session;
        $session->check_login();

        $this->view('main/ChangeUsername', $data);
    }

    public function changename()
    {
        defined('ROOTPATH') or define('ROOTPATH', __DIR__); // Define the root if not already defined
    
        // Session and JSON response settings
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    
        header('Content-Type: application/json');
    
        // Disable error reporting for clean JSON output in production
        ini_set('display_errors', 0);
        error_reporting(0);
    
        $response = [
            'success' => false,
            'message' => '',
            'errors' => []
        ];
    
        // Handle AJAX request and set the child session
        $request = json_decode(file_get_contents('php://input'), true);
        $session = new \Core\Session;
        $userid = $session->get('USERID');
    
        if (isset($request['name'])) {
            $name = $request['name'];
            $user = new \Modal\User;
    
            // Check if the new username already exists
            $result = $user->first(['Username' => $name]);
    
            if (!$result) {
    
                // Validate the new username
                $validationResult = $this->validateUsername($name);
                if ($validationResult === true) {
                    try {
                        // Update username across tables
                        $user->update(["UserID" => $userid], ["Username" => $name]);
    
                        // Update sessions
                        $session->unset("CHILDNAME");
                        $session->unset("Logged_In");
                        $session->unset("CHILD_ID");
                        $session->unset('USERNAME');

                        // All success actions, set response
                        $response['success'] = true;
                        $response['message'] = 'Username updated successfully. Redirecting to login...';
                    } catch (\Exception $e) {
                        // Catch any unexpected errors and return them in the response
                        $response['errors'][] = 'An error occurred: ' . $e->getMessage();
                        echo json_encode($response);
                        return; // Stop execution on error
                    }
                } else {
                    // Validation failed
                    $response['errors'][] = $validationResult;
                }
            } else {
                // Username already exists
                $response['errors'][] = "Username already exists.";
                $response['name'] = $name;
            }
        } else {
            // Name parameter missing in request
            $response['errors'][] = 'Name parameter missing in request';
        }
    
        // If no errors, return success response
        if (empty($response['errors'])) {
            $response['success'] = true;
            $response['message'] = 'Username Updated Successfully.';
        }
    
        // Send the response as JSON
        echo json_encode($response);
    }


    private function validateUsername($username)
    {
        // Regular expression to allow only alphanumeric, dashes, and underscores
        $invalidCharsRegex = '/[^a-zA-Z0-9_-]/';

        // Check if the username is at least 3 characters long
        if (strlen($username) < 3) {
            return 'Username must be at least 3 characters long';
        }

        // Check if the username contains invalid characters
        if (preg_match($invalidCharsRegex, $username)) {
            return 'Username can\'t contain special characters other than \'-\' or \'_\'';
        }

        // If both checks pass, return true indicating a valid username
        return true;
    }
}
