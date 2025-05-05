<?php

namespace Controller;

defined('ROOTPATH') or exit('Access denied');

class EnterEmail
{
    use MainController;
    public function index($data = null)
    {
        $this->view('Onbording/EnterEmail', $data);
    }

    public function StoreEmail()
    {
        defined('ROOTPATH') or define('ROOTPATH', __DIR__);
    
        // Start session and prepare JSON response
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    
        header('Content-Type: application/json');
    
        $response = [
            'success' => false,
            'message' => '',
            'errors' => []
        ];
    
        $request = json_decode(file_get_contents('php://input'), true);
    
        if (isset($request['email'])) {
            $email = trim($request['email']);

            $found = false;
            $session = new \Core\Session;
    
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
                $result = $modal->first([$role['field'] => $email]);
    
                if ($result) {
                    $found = true;
                    $session->set('VERIFIED_EMAIL', $email);
                    $response['success'] = true;
                    $response['message'] = 'Email found and verified successfully.';
                    break;
                }
            }
    
            if ($found) {
                $response['errors'][] = 'Email not found in the system.';
            }
    
        } else {
            $response['errors'][] = 'Email is required.';
        }
    
        echo json_encode($response);
    }
}

?>