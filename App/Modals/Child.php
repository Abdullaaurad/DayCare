<?php

namespace Modal;

defined('ROOTPATH') or exit('Access Denied!');

class Child
{
    use Modal;

    protected $table = 'child';
    protected $allowedColumns = [
        'ChildID',
        'ParentID',
        'Last_Name',
        'First_Name',
        'DOB',
        'Relation',
        'Language',
        'Nickname',
        'Religion',
        'Language',
        'Allergies',
        'Gender',
        'Image',
        'PackageID',
        'ImageType'
    ];

    public function validate()
    {
        $errors = [];

        // Validate First Name
        if (empty($_POST['First_Name']) || !preg_match("/^[a-zA-Z\s'-]+$/", $_POST['First_Name'])) {
            $errors['First_Name'] = "First Name is required and must contain only letters.";
        }

        // Validate Last Name
        if (empty($_POST['Last_Name']) || !preg_match("/^[a-zA-Z\s'-]+$/", $_POST['Last_Name'])) {
            $errors['Last_Name'] = "Last Name is required and must contain only letters.";
        }        

        // Validate Age
        $ageValidation = agecalculate($_POST['DOB']);
        if (is_string($ageValidation)) {
            // Set error only if the validation result is an error message
            if ($ageValidation === "Age must be at least 2 years" || 
                $ageValidation === "Age must be less than or equal to 12 years" || 
                $ageValidation === "Birthdate cannot be in the future") {
                $errors['DOB'] = $ageValidation;
            }
        }

        // Validate Relation
        if (empty($_POST['Relation']) || !is_string($_POST['Relation'])) {
            $errors['Relation'] = "Relation is required and must be a valid string.";
        }

        // Validate Language (optional check, but you might want it in the future)
        if (empty($_POST['Language']) || !is_string($_POST['Language'])) {
            $errors['Language'] = "Language is required and must be a valid string.";
        }

        // Validate Image
        if (isset($_FILES['Image']) && $_FILES['Image']['error'] !== UPLOAD_ERR_OK) {
            $errors['Image'] = "An error occurred while uploading the image.";
        } else {
            // Check if the image is present and validate it
            if (isset($_FILES['Image']) && $_FILES['Image']['error'] === UPLOAD_ERR_OK) {
                $imageFile = $_FILES['Image'];
                $imageType = mime_content_type($imageFile['tmp_name']);
                
                // Check if the image is a valid type (JPEG, PNG, GIF)
                if (!in_array($imageType, ['image/jpeg', 'image/png', 'image/gif'])) {
                    $errors['Image'] = "Unsupported image type. Please upload JPEG, PNG, or GIF images.";
                }

                // Optional: You can check for image size limits (e.g., max 2MB)
                if ($imageFile['size'] > 2 * 1024 * 1024) { // 2MB
                    $errors['Image'] = "The image file is too large. Maximum allowed size is 2MB.";
                }
            }
        }

        return $errors;
    }


    public function findById($id)
    {
        $sql = "SELECT * FROM child WHERE ChildID = :id LIMIT 1";
        $data = ['id' => $id];
        
        $result = $this->query($sql, $data);
        if ($result) {
            return $result[0]; // Return the first row
        }
        return false;
    }
}
