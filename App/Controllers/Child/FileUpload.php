<?php

namespace Controller;
use App\Helpers\FileHelper;

class FileUpload {
    use MainController;

    public function index() {
        $this->view('child/fileupload');
    }

    public function store() {
        $session = new \Core\Session;
         
        $session = new \core\Session();
        $UserID = $session->get('USERID'); // Get logged-in user ID

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_FILES['file'])) {
            $MediaModel = new \Modal\Media;

            $filehelper = new FileHelper;
            $fileData = $filehelper->store_file($_FILES['file']); // Use FileHelper to store the file

            if ($fileData) {
                $data = [
                    'MediaType' => $_POST['MediaType'],
                    'Title' => $_POST['Title'],
                    'Description' => $_POST['Description'],
                    'URL' => $fileData['url'],
                    'Size' => $fileData['size'],
                    'Format' => $fileData['format'],
                    'Views' => 0, // Default value
                    'Downloads' => 0, // Default value
                    'Category' => $_POST['Category'],
                    'Date' => date('Y-m-d H:i:s'),
                    'UserID' => $UserID
                ];

                if ($MediaModel->insert($data)) {
                    $_SESSION['success'] = "File uploaded successfully!";
                    header("Location: /child/fileupload");
                    exit;
                } else {
                    $_SESSION['error'] = "Failed to store activity.";
                }
            } else {
                $_SESSION['error'] = "File upload failed.";
            }
        } else {
            $_SESSION['error'] = "Invalid request.";
        }

        header("Location: /activity/create");
        exit;
    }
}
