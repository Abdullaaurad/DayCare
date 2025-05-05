<?php

namespace Controller;

defined('ROOTPATH') or exit('Access denied');

class ParentUser
{
    use MainController;

    public function index()
    {
        $session = new \Core\Session;
        $session->check_login();

        $Data = [];
        $UserID = $session->get('USERID');
        $session->unset('OTP');

        // Check if the user already exists
        $parent = new \Modal\ParentUser;
        $result = $parent->where_norder(["UserID" => $UserID]);
        if (!empty($result)) {
            redirect('Parent/Home');
        }

        // Required fields for validation
        $requiredFields = ['First_Name', 'Last_Name', 'Address', 'NID', 'Gender', 'Language'];

        // Check if the form is submitted with required fields and image
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && checkRequiredFields($requiredFields, $_POST)) {
            $errors = $parent->validate();

            if (empty($errors)) {
                $_POST['UserID'] = $UserID;

                // Check for an image upload
                if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === 0) {
                    // Get the MIME type of the uploaded file
                    $imageFile = $_FILES['profile_image'];
                    $imageType = mime_content_type($imageFile['tmp_name']);
                    if (in_array($imageType, ['image/jpeg', 'image/png', 'image/gif'])) {

                        // Read the image content as a binary blob
                        $imageBlob = file_get_contents($imageFile['tmp_name']);
                        if ($imageBlob === false) {
                            $errors['Image'] = "Failed to read the image file.";
                        } else {
                            // If there's an image blob in the session, use it, else store the new image
                            $_SESSION['profile_image_blob'] = $imageBlob;
                            $_SESSION['profile_image_type'] = $imageType;
                        }
                    } else {
                        $errors['Image'] = "Unsupported image type. Please upload JPEG, PNG, or GIF images.";
                    }
                }

                // Check if image exists in session, use it if no new image is uploaded
                if (!isset($_SESSION['profile_image_blob']) || empty($_SESSION['profile_image_blob'])) {
                    $_POST['Image'] = null;  // Fallback to null if no image is available
                } else {
                    $_POST['Image'] = $_SESSION['profile_image_blob'];
                    $_POST['ImageType'] = $_SESSION['profile_image_type'];
                }

                // Continue with form data processing
                $_POST['Email'] = $session->get('EMAIL');
                $_POST['Phone_Number'] = $session->get('NUMBER');

                // Insert into the database
                $parent->insert($_POST);

                // Clear session data after successful insertion
                $session->unset('NUMBER');
                $session->unset('EMAIL');
                $session->unset('EMAIL_VARIFIED');
                $session->unset('CONTACT_VARIFIED');
                $session->unset('OTP');
                $session->unset('VERIFIED_PHONE');

                // Redirect to the next step in the onboarding process
                redirect('Onbording/Child');
            } else {
                // If there are validation errors, pass them to the view
                $values = $this->setvalues();
                $Data['values'] = $values;
                $Data['errors'] = $errors;
                // $this->view('Onbording/ParentUser', $Data);
            }
        }

        // Fetch the username of the logged-in user
        $user = new \Modal\User;
        $result = $user->first(['UserID' => $UserID]);
        $username = $result->Username;
        $Data['username'] = $username;

        // Load the view with the user data
        $this->view('Onbording/ParentUser', $Data);
    }

    // This method is used to set the form values
    private function setvalues()
    {
        $values = [];
        $values['First_Name'] = $_POST['First_Name'] ?? '';
        $values['Last_Name'] = $_POST['Last_Name'] ?? '';
        $values['Phone_Number'] = $_POST['Phone_Number'] ?? '';
        $values['Address'] = $_POST['Address'] ?? '';
        $values['NID'] = $_POST['NID'] ?? '';
        $values['Email'] = $_POST['Email'] ?? '';

        // Check if an image is uploaded and convert to base64 if present
        if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
            $imageData = file_get_contents($_FILES['profile_image']['tmp_name']);
            $base64 = 'data:' . $_FILES['profile_image']['type'] . ';base64,' . base64_encode($imageData);
            $values['profile_image_base64'] = $base64;
        } else {
            $values['profile_image_base64'] = null;
        }

        return $values;
    }
}
