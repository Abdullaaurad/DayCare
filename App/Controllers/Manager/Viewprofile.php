<?php

namespace Controller;
use App\Helpers\ManagerHelper;

defined('ROOTPATH') or exit('Access denied');

use Core\Mailer;

class Viewprofile
{
    use MainController;

    public function index()
    {
        $Helper = new ManagerHelper;
        $Helper->Check_Manager();
        $user = new \Modal\User;
        $result = $user->findall();
        $data = ['userData' => $result];

        $this->view('Manager/Viewprofile/Account', $data);
    }

    public function store_users()
    {
        header('Content-Type: application/json');
        $requestData = json_decode(file_get_contents("php://input"), true);
        $TeacherModal = new \Modal\Teacher;
        $MaidModal = new \Modal\Maid;
        $DoctorModal = new \Modal\Doctor;
        $ManagerModal = new \Modal\Manager;
        $ReceptionistModal = new \Modal\Receptionist;
        $ParentModal = new \Modal\ParentUser;

        // Get role and ID from request
        $Role = isset($requestData['role']) ? $requestData['role'] : 'All';
        $UserID = isset($requestData['id']) ? $requestData['id'] : null;

        $UsersModal = new \Modal\User;
        $Usersrecords = $UsersModal->findAll();

        foreach ($Usersrecords as $key => $User) {
            // Fetch partner data based on role.
            switch ($User->Role) {
                case 'User':
                    $Data = $ParentModal->first(["UserID" => $User->UserID]);
                    break;
                case 'Teacher':
                    $Data = $TeacherModal->first(["UserID" => $User->UserID]);
                    break;
                case 'Maid':
                    $Data = $MaidModal->first(["UserID" => $User->UserID]);
                    break;
                case 'Doctor':
                    $Data = $DoctorModal->first(["UserID" => $User->UserID]);
                    break;
                case 'Manager':
                    $Data = $ManagerModal->first(["UserID" => $User->UserID]);
                    break;
                case 'Receptionist':
                    $Data = $ReceptionistModal->first(["UserID" => $User->UserID]);
                    break;
                default:
                    $Data = null;
                    break;
            }
        
            // Skip user if no associated role data is found
            if (!empty($Data)) {
                if (!empty($Data->Image) && !empty($Data->ImageType) && $Data->ImageType != 'null' && $Data->Image != null) {
                    $imageData = $Data->Image;
                    $imageType = $Data->ImageType;
                    $base64Image = is_string($imageData)
                        ? 'data:' . $imageType . ';base64,' . base64_encode($imageData)
                        : null;
                    $Usersrecords[$key]->Image = $base64Image;
                } else {
                    $Usersrecords[$key]->Image = IMAGE . "/ProfilePic.png";
                }
            }else{
                $Usersrecords[$key]->Image = IMAGE . "/ProfilePic.png";
            }
        }
        
        $Usersrecords = array_values($Usersrecords);

        $Usersrecords = array_filter($Usersrecords, function ($user) {
            return $user->Role !== "Manager";
        });

        // Filter by Role if specified
        if ($Role !== 'All') {
            $Usersrecords = array_filter($Usersrecords, function ($user) use ($Role) {
                return $user->Role === $Role;
            });
        }

        // Filter by UserID if provided
        if (!empty($UserID)) {
            $Usersrecords = array_filter($Usersrecords, function ($user) use ($UserID) {
                return $user->UserID == $UserID;
            });
        }

        // Return filtered and processed data
        if (empty($Usersrecords)) {
            echo json_encode(['success' => false, 'message' => 'No data found for the selected filters']);
        } else {
            echo json_encode(['success' => true, 'data' => array_values($Usersrecords)]);
        }
    }

    public function adduser()
    {
        $model = new \Modal\User;
        $mailer = new \Core\Mailer;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Prepare user data
            $otherValue = null;

            if (!empty($_POST['Role']) && $_POST['Role'] == 'Teacher') {
                $otherValue = trim($_POST['Subject']);
            } elseif (!empty($_POST['Age']) && $_POST['Role'] == 'Maid') {
                $otherValue = trim($_POST['Age']);
            }

            // Prepare user data
            $dataInsert = [
                'Username' => trim($_POST['Username']),
                'Password' => password_hash($_POST['Password'], PASSWORD_DEFAULT),
                'Role' => trim($_POST['Role']),
                'email' => filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL),
                'Other' => $otherValue
            ];

            $data = [
                'Username' => trim($_POST['Username']),
                'Password' => $_POST['Password'],
                'Role' => trim($_POST['Role']),
                'email' => filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL)
            ];

            // Validate data
            if ($model->validate($data, $dataInsert)) {
                // Insert user
                $model->insert($dataInsert);

                $subject = "Welcome to KiddoVille Daycare";
                $body = $this->getWelcomeEmailTemplate($data);

                // Send email
                $emailResult = $mailer->send($data['email'], $subject, $body);

                if ($emailResult) {
                    message("User added successfully. Welcome email sent!");
                } else {
                    message("User added but email failed Sending ");
                }


                redirect('Manager/Viewprofile');
            }
        }
    }


    public function viewuser(){
        $parentmodel = new \Modal\ParentUser;
        $teachermodel = new \Modal\Teacher;
        $maidmodel = new \Modal\Maid;
        $doctormodel = new \Modal\Doctor;
        $reciptionistmodel = new \Modal\Receptionist;
        
        
    }

    public function getWelcomeEmailTemplate($userData)
{
    $roleDisplay = ($userData['Role'] == 'User') ? 'Parent' : $userData['Role'];
    
    return '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to KiddoVille</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f5f7fa;
            font-family: \'Poppins\', Arial, sans-serif;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            overflow: hidden;
            background-color: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }
        .header {
            background-color: #e8f5e9;
            padding: 25px 0;
            text-align: center;
            border-bottom: 1px solid #eaeaea;
        }
        .header img {
            height: 60px;
            margin-bottom: 15px;
        }
        .header h2 {
            margin: 0;
            color: #2e7d32;
            font-weight: 600;
            font-size: 22px;
        }
        .content {
            padding: 30px 40px;
            color: #4a4a4a;
        }
        .greeting {
            font-size: 18px;
            font-weight: 500;
            margin-bottom: 20px;
        }
        .credentials {
            background-color: #f1f8e9;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #689f38;
        }
        .credentials h3 {
            margin-top: 0;
            color: #2e7d32;
        }
        .login-button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #43a047;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 500;
            margin: 15px 0;
        }
        .footer {
            background-color: #f9f9ff;
            padding: 20px;
            text-align: center;
            font-size: 13px;
            color: #95a5a6;
            border-top: 1px solid #eaeaea;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <img src="cid:kiddoLogo" alt="KiddoVille Logo">
            <h2>Welcome to KiddoVille!</h2>
        </div>

        <div class="content">
            <p class="greeting">Dear ' . htmlspecialchars($userData['Full_Name']) . ',</p>
            
            <p>Your ' . htmlspecialchars($roleDisplay) . ' account has been successfully created by the KiddoVille management team.</p>
            
            <div class="credentials">
                <h3>Your Login Credentials:</h3>
                <p><strong>Username:</strong> ' . htmlspecialchars($userData['Username']) . '</p>
                <p><strong>Password:</strong> ' . htmlspecialchars($userData['Password']) . '</p>
                <p><em>(You will be prompted to change your password after first login)</em></p>
            </div>

            <p>To access your account, please click the button below:</p>
            
            <a href="https://kiddoville.com/login" class="login-button">Login to Your Account</a>
            
            <p>For security reasons, we recommend:</p>
            <ul>
                <li>Changing your password immediately after first login</li>
                <li>Not sharing your credentials with anyone</li>
                <li>Contacting support if you didn\'t request this account</li>
            </ul>
        </div>

        <div class="footer">
            <p>&copy; ' . date("Y") . ' KiddoVille Inc. All rights reserved.</p>
            <p>KiddoVille Inc., 106/37, Nawagampura, Stace Road, Colombo 14, Sri Lanka</p>
        </div>
    </div>
</body>
</html>';
}






    private function blockEmailTemplate($userData)
    {
        $roleDisplay = ($userData['Role'] == 'User') ? 'Parent' : $userData['Role'];

        return  '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KiddoVille Account Blocked</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f5f7fa;
            font-family: \'Poppins\', Arial, sans-serif;
        }

        .email-container {
            max-width: 600px;
            margin: 20px auto;
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            overflow: hidden;
            background-color: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .header {
            background-color: #fce4e4;
            padding: 25px 0;
            text-align: center;
            border-bottom: 1px solid #eaeaea;
        }

        .header img {
            height: 60px;
            margin-bottom: 15px;
        }

        .header h2 {
            margin: 0;
            color: #c0392b;
            font-weight: 600;
            font-size: 22px;
        }

        .content {
            padding: 30px 40px;
            color: #4a4a4a;
        }

        .greeting {
            font-size: 18px;
            font-weight: 500;
            margin-bottom: 20px;
        }

        .message {
            line-height: 1.6;
            margin-bottom: 25px;
        }

        .instructions {
            background-color: #f9fbfd;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 25px;
            border-left: 4px solid #e74c3c;
        }

        .instructions h3 {
            margin-top: 0;
            color: #e74c3c;
            font-size: 16px;
        }

        .instructions ul {
            margin-bottom: 0;
            padding-left: 20px;
        }

        .instructions li {
            margin-bottom: 8px;
        }

        .support {
            text-align: center;
            margin: 30px 0 15px;
        }

        .support-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #e74c3c;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 500;
            margin-top: 10px;
        }

        .divider {
            height: 1px;
            background-color: #eaeaea;
            margin: 25px 0;
        }

        .footer {
            background-color: #f9f9ff;
            padding: 20px;
            text-align: center;
            font-size: 13px;
            color: #95a5a6;
            border-top: 1px solid #eaeaea;
        }

        .footer p {
            margin: 5px 0;
        }

        .address {
            margin-top: 15px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <img src="cid:kiddoLogo" alt="KiddoVille Logo">
            <h2>Account Access Blocked</h2>
        </div>

        <div class="content">
            <p class="greeting">Dear ' . htmlspecialchars($roleDisplay) . ',</p>

            <div class="message">
                <p>We regret to inform you that your access to the KiddoVille application as a <strong>' . htmlspecialchars($roleDisplay) . '</strong> has been <span style="color:#e74c3c;"><strong>blocked</strong></span>.</p>
                <p>This action may have been taken due to policy violations, account inactivity, or administrative decisions.</p>
            </div>

            <div class="instructions">
                <h3>What to do next:</h3>
                <ul>
                    <li>If you believe this is a mistake, please contact our support team.</li>
                    <li>You will not be able to log in until the issue is resolved.</li>
                    <li>Do not attempt to create a new account without prior authorization.</li>
                </ul>
            </div>

            <div class="support">
                <p>Need clarification or help?</p>
                <a href="https://kiddoville.com/support" class="support-button">Contact Support</a>
            </div>

            <div class="divider"></div>
        </div>

        <div class="footer">
            <p>&copy; ' . date("Y") . ' KiddoVille Inc. All rights reserved.</p>
            <div class="address">
                KiddoVille Inc.,<br>
                106/37 , Nawagampura, Stace Road, Colombo 14, Sri Lanka<br>
                Phone: +94 71 481 0928<br>
            </div>
        </div>
    </div>
</body>
</html>';
    }

    public function handleusername()
    {
        header('Content-Type: application/json');
        $requestData = json_decode(file_get_contents("php://input"), true);

        $Username = isset($requestData['Username']) ? $requestData['Username'] : null;

        if (!empty($Username)) {
            $model = new \Modal\User;
            $result = $model->first(["Username" => $Username]);

            if ($result) {
                echo json_encode(['success' => false, 'message' => 'Username already exists']);
            } else {
                echo json_encode(['success' => true, 'message' => 'Username is available']);
            }
        }
    }

    public function blockuser()
    {
        header('Content-Type: application/json');
        $requestData = json_decode(file_get_contents("php://input"), true);
        $Mailer = new \core\Mailer;
        $UserModal = new \Modal\User;
        $TeacherModal = new \Modal\Teacher;
        $MaidModal = new \Modal\Maid;
        $ChildModal = new \Modal\Child;
        $DoctorModal = new \Modal\Doctor;
        $ManagerModal = new \Modal\Manager;
        $ReceptionistModal = new \Modal\Receptionist;
        $ParentModal = new \Modal\ParentUser;
    
        $UserID = isset($requestData['UserID']) ? $requestData['UserID'] : null;
        $model = new \Modal\User;
    
        if (!empty($UserID)) {
            // ✅ Block the user
            $model->update_withid($UserID, ["Block" => 1], "UserID");
    
            // ✅ Get email body template
            $body = $this->blockEmailTemplate($UserID);
    
            // ✅ Get user info
            $User = $UserModal->first(["UserID" => $UserID]);
            $Data = 0;
    
            if (!empty($User)) {
                // ✅ Identify and get role-specific data
                switch ($User->Role) {
                    case 'User':
                        $Data = $ParentModal->first(["UserID" => $User->UserID]);
                        break;
                    case 'Teacher':
                        $Data = $TeacherModal->first(["UserID" => $User->UserID]);
                        break;
                    case 'Maid':
                        $Data = $MaidModal->first(["UserID" => $User->UserID]);
                        break;
                    case 'Doctor':
                        $Data = $DoctorModal->first(["UserID" => $User->UserID]);
                        break;
                    case 'Manager':
                        $Data = $ManagerModal->first(["UserID" => $User->UserID]);
                        break;
                    case 'Receptionist':
                        $Data = $ReceptionistModal->first(["UserID" => $User->UserID]);
                        break;
                    default:
                        $Data = null;
                        break;
                }
    
                // ✅ Send email if role data found
                if (!empty($Data)) {
                    $Mailer->send(
                        $Data->Email,
                        'Account Blocked',
                        $body,
                    );
                }
            }
    
            echo json_encode(['success' => true, 'message' => 'Blocked User Successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error in blocking user']);
        }
    }
    

    public function unblockuser()
    {
        header('Content-Type: application/json');
        $requestData = json_decode(file_get_contents("php://input"), true);

        $UserID = isset($requestData['UserID']) ? $requestData['UserID'] : null;
        $model = new \Modal\User;

        if (!empty($UserID)) {
            $model->update_withid($UserID, ["Block" => 0], "UserID");
            echo json_encode(['success' => true, 'message' => 'Unblocked User Successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error in unblocking user']);
        }
    }
}
