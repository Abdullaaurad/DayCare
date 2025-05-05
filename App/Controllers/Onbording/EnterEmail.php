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

    public function StoreEmail(){
        defined('ROOTPATH') or define('ROOTPATH', __DIR__);
    
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
            $emailExists = false;
    
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
                    $emailExists = true;
                    break;
                }
            }
    
            if ($emailExists) {
                $response['errors'][] = 'Email already exists in the system.';
            } else {
                $session = new \Core\Session;
                $session->set('EMAIL', $email);
                $response['success'] = true;
                $response['message'] = 'Email is available for registration.';
            }
    
        } else {
            $response['errors'][] = 'Email is required.';
        }
    
        echo json_encode($response);
    }    
}

?>