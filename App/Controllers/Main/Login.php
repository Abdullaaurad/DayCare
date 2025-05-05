<?php


namespace Controller;

defined('ROOTPATH') or exit('Access denied');

class Login
{
    use MainController;

    public function index()
    {
        $Data = [];
        if (isset($_POST['Username']) && isset($_POST['Password'])) {
            if (isset($_POST['Username'])) {
                $user = new \Modal\User;
                $username = $_POST['Username'];

                $password = $_POST['Password'];

                // Validate password strength FIRST
                $passwordErrors = [];

                if (!preg_match('/[A-Z]/', $password)) {
                    $passwordErrors = "Password must contain at least one uppercase letter.";
                }
                if (!preg_match('/[0-9]/', $password)) {
                    $passwordErrors = "Password must contain at least one number.";
                }               
                if (strlen($password) < 8) {
                    $passwordErrors = "Password must be at least 8 characters long.";
                }

                $usernameErrors = [];
                if (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
                    $usernameErrors = "Username can only contain letters, numbers, and underscores (no special characters like @, $, etc.).";
                }
                if (strlen($username) > 20) {
                    $usernameErrors = "Username must be less than or equal to 20 characters.";
                }

                if(!empty($usernameErrors)) {
                    // If username is invalid, return error
                    $user->values['uservalue'] = $username;
                    $Data['value'] = $user->values;


                    $user->errors['username'] = $usernameErrors;
                    $Data['errors'] = $user->errors;

                    $this->view('Main/Login', $Data);
                    return;
                }

                if (!empty($passwordErrors)) {
                    // If password is weak, return error
                    $user->values['uservalue'] = $username;
                    $Data['value'] = $user->values;


                    $user->errors['password'] = $passwordErrors;
                    $Data['errors'] = $user->errors;

                    $this->view('Main/Login', $Data);
                    return; // Stop further execution
                }

                $result = $user->first(['Username' => $username]);

                if($result && $result->Block == 1){
                    redirect('Main/Block');
                }

                if (!empty($result)) {
                    if (checkpassword($_POST["Password"], $result->Password)) {

                        $session = new \Core\Session;
                        $session->set(['USERID' => $result->UserID]);
                        $session->set(['Logged_In' => true]);

                        if ($result->Role === "User") {
                            $parent = new \Modal\ParentUser;
                            $pre = $parent->first(['UserID' => $result->UserID]);
                            if (empty($pre)) {
                                redirect('Onbording/ParentUser');
                            } else {
                                $lastseen = date('Y-m-d H:i:s');
                                $parent->update(["UserID" => $result->UserID], ["Last_Seen" => $lastseen]);

                                $child = new \Modal\Child;
                                $children = $child->where_norder(["ParentID" => $pre->ParentID]);
                                if (!$children) {
                                    redirect('Onbording/Child');
                                } else {
                                    redirect('Parent/Home');
                                }
                            }
                        }
                        if ($result->Role === "Teacher") {
                            $teacher = new \Modal\Teacher;
                            $lastseen = date('Y-m-d H:i:s');
                            $teacher->update(["UserID" => $result->UserID], ["Last_Seen" => $lastseen]);

                            redirect('Teacher/Dashboard');
                        }
                        if ($result->Role === "Maid") {
                            $maid = new \Modal\Maid;
                            $lastseen = date('Y-m-d H:i:s');
                            $maid->update(["UserID" => $result->UserID], ["Last_Seen" => $lastseen]);
                            redirect('Maid/Home');
                        }
                        if ($result->Role === "Manager") {
                            $Manager = new \Modal\Manager;
                            $lastseen = date('Y-m-d H:i:s');
                            $session->set('Manager', 1);
                            $Manager->update(["UserID" => $result->UserID], ["Last_Seen" => $lastseen]);
                            redirect('Manager/Home');
                        }
                        if ($result->Role === "Receptionist") {
                            $receptionist = new \Modal\Receptionist;
                            $lastseen = date('Y-m-d H:i:s');
                            $receptionist->update(["UserID" => $result->UserID], ["Last_Seen" => $lastseen]);
                            redirect('Receptionist/Home');
                        }
                        if ($result->Role === "Doctor") {
                            $doctor = new \Modal\Doctor;
                            $lastseen = date('Y-m-d H:i:s');
                            $doctor->update(["UserID" => $result->UserID], ["Last_Seen" => $lastseen]);
                            redirect('Doctor/Dashboard');
                        }
                        if ($result->Role) {
                            redirect('_404');
                        }
                    } else {
                        $user->values['uservalue'] = $username;
                        $Data['value'] = $user->values;

                        $user->errors['password'] = "password mismatch";
                        $Data['errors'] = $user->errors;
                    }
                } else {
                    $user->errors['username'] = "username doesn't exists";
                    $Data['errors'] = $user->errors;

                    $user->values['uservalue'] = $username;
                    $Data['value'] = $user->values;
                }
            }
        }
        $this->view('Main/Login', $Data);
    }
}
