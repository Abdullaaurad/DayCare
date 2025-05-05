<?php

namespace Controller;

defined('ROOTPATH') or exit('Access denied');

class Signup {
    use MainController;

    public function index() {
        $Data = [];
        $Data['errors'] = null;  // Initialize the error array
        $Data['inputs'] = [];    // Initialize the input array

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];
            $inputs = [];

            // Save user input safely
            $inputs['Name'] = trim($_POST['Name'] ?? '');
            $inputs['NIC'] = trim($_POST['NIC'] ?? '');
            $inputs['Contact'] = trim($_POST['Contact'] ?? '');
            $inputs['Email'] = trim($_POST['Email'] ?? '');
            $inputs['Address'] = trim($_POST['Address'] ?? '');

            $existing = new \Modal\Meeting_Request;
            $result = $existing->where_norder(['NIC' => $inputs['NIC']]);

            // if (!empty($result)) {
            //     $errors['request'] = 'Request already exists.';
            // }

            // Validate Name: Only letters and spaces allowed
            if (!preg_match('/^[a-zA-Z\s]+$/', $inputs['Name'])) {
                $errors['Name'] = 'Name can only contain letters and spaces.';
            }

            // Validate NIC: Only numbers, exactly 12 digits
            if (!preg_match('/^\d{12}$/', $inputs['NIC'])) {
                $errors['NIC'] = 'NIC must be exactly 12 digits and contain only numbers.';
            }

            // Validate Contact: Only numbers, exactly 10 digits
            if (!preg_match('/^\d{10}$/', $inputs['Contact'])) {
                $errors['Contact'] = 'Contact must be exactly 10 digits and contain only numbers.';
            }

            // Validate Email: Must be a valid email format
            if (!filter_var($inputs['Email'], FILTER_VALIDATE_EMAIL)) {
                $errors['Email'] = 'Please enter a valid email address.';
            }

            // Optional: Validate Address (if exists)
            if (!empty($inputs['Address']) && strlen($inputs['Address']) < 5) {
                $errors['Address'] = 'Address must be at least 5 characters long.';
            }

            if (!empty($errors)) {
                // If errors, send errors + inputs back
                $Data['errors'] = $errors;
                $Data['inputs'] = $inputs;
                
            } else {
                // No errors, proceed
                $meeting = new \Modal\Meeting_Request;

                $_POST['PhoneNumber'] = $inputs['Contact'];
                unset($_POST['Contact']);
                $meeting->insert($_POST);

                // $this->view('main/signup', $Data, [
                //     'success' => 'Request submitted successfully.',
                //     'inputs' => $inputs,
                // ]);
                redirect('main/home');
            }
        }

        $this->view('main/signup', $Data);
    }
}

?>
