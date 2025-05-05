<?php

    namespace Controller;

    defined('ROOTPATH') or exit('Access denied');

    class Guardian{
        use MainController;
        public function index(){
            $session = new \Core\Session;
            $session->check_login();

            $Data = [];
            $this->view('Onbording/Guardian' , $Data);
        }

        public function handlesubmission() {
            $session = new \Core\Session;
            $UserID = $session->get('USERID');
        
            $Parent = new \Modal\ParentUser;
            $guardian = new \Modal\Guardian;
        
            $location = $session->get("Location");
        
            $ParentID = ($Parent->first(["UserID" => $UserID]))->ParentID;
            $result = $guardian->where_norder(['ParentID' => $ParentID]);
        
            if (!empty($result)) {
                if (isset($location)) {
                    redirect($location);
                }
                redirect('Parent/Home');
            }
            redirect('Parent/Home');
            // Define required fields
            $requiredFields = ['First_Name', 'Last_Name', 'Relation', 'Phone_Number', 'Language', 'Address', 'NID', 'Email'];
        
            // Check if all required fields are present in the POST request
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && checkRequiredFields($requiredFields, $_POST)) {
                $errors = $guardian->validate();
        
                // If there are no errors
                if (empty($errors)) {
                    $_POST['ParentID'] = $ParentID;
        
                    // Check if a new image has been uploaded
                    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === 0) {
                        // Read the image file and get the MIME type
                        $imageFile = $_FILES['profile_image'];
                        $imageType = mime_content_type($imageFile['tmp_name']);

        
                        // Validate that the image type is acceptable
                        if (in_array($imageType, ['image/jpeg', 'image/png', 'image/gif'])) {
                            $imageBlob = file_get_contents($imageFile['tmp_name']);
                            if ($imageBlob === false) {
                                $errors['Image'] = "Failed to read the image file.";
                            } else {
                                // Store the image in session
                                $_SESSION['profile_image_blob'] = $imageBlob;
                                $_SESSION['profile_image_type'] = $imageType;
        
                                // Set the image and image type in the POST data
                                $_POST['Image'] = $imageBlob;
                                $_POST['ImageType'] = $imageType;
                            }
                        } else {
                            $errors['Image'] = "Unsupported image type. Please upload JPEG, PNG, or GIF images.";
                        }
                    }
        
                    // If there are no errors, insert the data into the database or update it if needed
                    if (empty($errors)) {
                        if (empty($result)) {
                            // If no existing guardian record, insert a new one
                            $imageBlob = $_SESSION['profile_image_blob'];
                            $imageType = $_SESSION['profile_image_type'];
                            $_POST['Image'] = $imageBlob;
                            $_POST['ImageType'] = $imageType;
                            $guardian->insert($_POST);
                            $session->unset('CHILDID');
                            $session->unset('PARENTID');
                            redirect('Parent/Home');
                        } else {
                            // If a guardian already exists, update the record
                            $guardian->update(['ParentID' => $ParentID], $_POST);
                            redirect('Parent/Home');
                        }
                    } else {
                        // If errors, prepare data for the view
                        $values = $this->setvalues();
                        $Data['values'] = $values;
                        $Data['errors'] = $errors;
                        redirect('Parent/Home');
                    }
                } else {
                    // If required fields are missing, prepare data for the view
                    $values = $this->setvalues();
                    $Data['values'] = $values;
                    $Data['errors'] = $errors;
                    redirect('Parent/Home');
                }
            }
        }            
    
        private function setvalues() {
            $values = [
                'First_Name'   => $_POST['First_Name'] ?? '',
                'Last_Name'    => $_POST['Last_Name'] ?? '',
                'Phone_Number' => $_POST['Phone_Number'] ?? '',
                'Address'      => $_POST['Address'] ?? '',
                'NID'          => $_POST['NID'] ?? '',
                'Email'        => $_POST['Email'] ?? '',
                'Relation'     => $_POST['Relation'] ?? '',
                'Gender'       => $_POST['Gender'] ?? '',
                'Language'     => $_POST['Language'] ?? ''
            ];
        
            // If image was previously uploaded (e.g., from DB), keep it
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
?>