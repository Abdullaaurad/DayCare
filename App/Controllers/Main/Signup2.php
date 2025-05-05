<?php
    namespace Controller;
    defined('ROOTPATH') or exit('Access denied');
    
    class Signup2{
        use MainController;
        public function index(){
            $Data = [];
            $Data['errors'] = 'hi';
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Username']) && isset($_POST['Password']) && isset($_POST['confirm-password'])) {
                if (isset($_POST['Username'])) {
                    $user = new \Modal\User;
                    $username = $_POST['Username'];
                    $result = $user->first(['Username' => $username]);
                    if(!$result){
                        if($_POST['Password'] === $_POST['confirm-password']){
                            $Encrypted_password = hashpassword($_POST['Password']);
                            $date = date('Y-m-d H:i:s');
                            $user->insert(['Username' => $username, 'Password'=> $Encrypted_password,'Date'=> $date ]);
                            $Error['errors'] = '';
                            sleep(1.65);
                        }
                        else{
                            redirect('Main/Login');
                        }
                    }
                    else{
                        $user->errors['username'] = 'username already exists';
                        $Data['errors'] = $user->errors;
                        $user->values['uservalue'] = $username;
                        $Data['value'] = $user->values;
                    }
                }
            }
            $this->view('main/signup2',$Data);
        }
    }
?>