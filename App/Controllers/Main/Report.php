<?php

    namespace Controller;

    defined('ROOTPATH') or exit('Access denied');

    class Report{
        use MainController;
        public function index(){

            $this->view('main/Report');
        }

        public function Send()
        {
            // Validate email
            if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                redirect('Main/Report');
            }
        
            $sender = $_POST['email'];
            $subject = $_POST['category'] ?? 'No category specified';
            $body = $_POST['description'] ?? 'No description provided';
        
            $mail = new \core\Mailer;
            $result = $mail->send($sender, $subject, $body);
        
            if ($result) {
                redirect('Main/Report');
            } else {
                $data = [
                    'email' => $sender,
                    'category' => $_POST['category'] ?? '',
                    'description' => $_POST['description'] ?? '',
                ];
        
                // Optionally, clear errors
                unset($_SESSION['error']);
        
                $this->view('main/Report', $data);
            }
        }
        
    }
?>