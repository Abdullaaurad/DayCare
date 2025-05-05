<?php

namespace Controller;

defined('ROOTPATH') or exit('Access denied');

class EnterNumber
{
    use MainController;

    public function index($data = null)
    {
        $this->view('main/EnterNumber', $data);
    }

    public function StorePhone()
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

        if (isset($request['phoneNumber'])) {
            $phoneNumber = trim($request['phoneNumber']);

            if (!preg_match('/^0\d{9}$/', $phoneNumber)) {
                $response['errors'][] = 'Invalid phone number format.';
                echo json_encode($response);
                return;
            }

            $found = false;
            $session = new \Core\Session;

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
                $result = $modal->first([$role['field'] => $phoneNumber]);

                if ($result) {
                    $found = true;
                    $session->set('VERIFIED_PHONE', $phoneNumber);
                    $response['success'] = true;
                    $response['message'] = 'Phone number verified successfully.';
                    break;
                }
            }

            if (!$found) {
                $response['errors'][] = 'Phone number not found in the system.';
            }
        } else {
            $response['errors'][] = 'Phone number is required.';
        }

        echo json_encode($response);
    }
}

?>
