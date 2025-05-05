<?php

namespace Controller;

defined('ROOTPATH') or exit('Access denied');

class ChildEditProfile
{
    use MainController;
    public function index()
    {
        $session = new \Core\Session;
        $session->set("USERID", 1);
        $data = [];

        $session = new \core\Session;
        $ChildID = $session->get("CHILDID");

        $child = new \Modal\Child;
        $childdocumentModal = new \Modal\ChildDocuments;
        $childmedicationModal = new \Modal\ChildMedication;
        $ParentModal = new \Modal\ParentUser;

        $data['children'] = $child->first(["ChildID"=> $ChildID]);
        $Parent = $ParentModal->first(["ParentID" => $data['children']->ParentID]);

        $data['children']->Email = $Parent->Email;
        $data['children']->Phone_Number = $Parent->Phone_Number;
        $imageData = $data['children']->Image;
        $imageType = $data['children']->ImageType;  // Get the image MIME type from the database

        // If image data is available, construct the Base64 string using the correct MIME type
        $base64Image = (!empty($imageData) && is_string($imageData))
            ? 'data:' . $imageType . ';base64,' . base64_encode($imageData)
            : null
        ;

        $data['children']->Image = $base64Image;

        $data['medications'] = $childmedicationModal->where_norder(["ChildID" => $ChildID]);
        if(!empty($data['medications'])){
            foreach ($data['medications'] as $medication){
                $imageData = $medication->MedicationImage;
                $imageType = $medication->ImageType;  // Get the image MIME type from the database
        
                // If image data is available, construct the Base64 string using the correct MIME type
                $base64Image = (!empty($imageData) && is_string($imageData))
                    ? 'data:' . $imageType . ';base64,' . base64_encode($imageData)
                    : null
                ;

                $medication->MedicationImage = $base64Image;
            }
        }
        
        $data['documents'] = $childdocumentModal->where_norder(["ChildID" => $ChildID]);
        if(!empty($data['documents'])){
            foreach ($data['documents'] as $document){
                $imageData = $document->UploadedFile;
                $imageType = $document->FileType;  // Get the image MIME type from the database
        
                // If image data is available, construct the Base64 string using the correct MIME type
                $base64Image = (!empty($imageData) && is_string($imageData))
                    ? 'data:' . $imageType . ';base64,' . base64_encode($imageData)
                    : null
                ;

                $document->UploadedFile = $base64Image;
            }
        }

        $this->view('Child/childeditprofile', $data);
    }

    public function Savedetails() {
        $session = new \Core\Session;
        $session->set("USERID", 1);
        $postData = $_POST;
    
        $images = isset($postData['images']) ? json_decode($postData['images'], true) : [];
        $files = isset($postData['files']) ? json_decode($postData['files'], true) : [];
        unset($postData['images'], $postData['files']);

        if (isset($_FILES['profileimage']) && $_FILES['profileimage']['error'] === UPLOAD_ERR_OK) {
            $imageTmpPath = $_FILES['profileimage']['tmp_name'];
            $imageType = $_FILES['profileimage']['type'];
    
            $imageData = file_get_contents($imageTmpPath);
    
            $postData['Image'] = $imageData;
            $postData['ImageType'] = $imageType;
        }

        $session = new \core\Session;
        $ChildModal = new \Modal\Child;

        $ChildID = $session->get("CHILDID");
        $ChildModal->update(["ChildID" => $ChildID] , $postData); 

        $childdocumentModal = new \Modal\ChildDocuments;
        $childmedicationModal = new \Modal\ChildMedication;

        $data['medications'] = $childmedicationModal->where_norder(["ChildID" => $ChildID]);
        $data['documents'] = $childdocumentModal->where_norder(["ChildID" => $ChildID]);

        if(!empty($images)){
            foreach ($images as $image) {
                if (!isset($image['ImageID'])) {
                    $base64String = $image['MedicationImage'];

                    // Check if the base64 string has the prefix and remove it
                    if (strpos($base64String, 'base64,') !== false) {
                        $base64String = explode('base64,', $base64String)[1]; // Get the actual base64 data
                    }
            
                    // Decode the base64 string into binary data
                    $binaryImage = base64_decode($base64String);
            
                    if ($binaryImage === false) {
                        die("Error decoding base64 image"); // If decoding fails
                    }

                    $medicationData = [
                        'MedicationImage' => $binaryImage, // Store the binary data (BLOB)
                        'DateAdded' => date('Y-m-d H:i:s'),
                        'ChildID' => $ChildID,
                        'ImageType' => $image['FileType'] ?? 'image/jpeg', // Use the FileType (MIME type) from the uploaded image
                    ];
            
                    $childmedicationModal->insert($medicationData);
                }
            }
        }

        if(!empty($data['medications'])){
            foreach ($data['medications'] as $existingImage) {
                // Check if this existing image's ImageID is present in the $images array
                $found = false;
            
                foreach ($images as $image) {
                    // Compare ImageID from the images array to the existing ImageID in the database
                    if (isset($image['ImageID']) && $existingImage->ImageID === $image['ImageID']) {
                        $found = true;
                        break; // Exit the loop early if a match is found
                    }
                }
            
                // If the ImageID from the database is not found in the $images array, delete it
                if (!$found) {
                    // Delete the image from the database (childmedicationModal)
                    $childmedicationModal->delete($existingImage->ImageID , "ImageID");
                }
            }
        }
    
        if(!empty($files)){
            foreach ($files as $file) {
                if (!isset($file['FileID']) && isset($file['FileType']) && isset($file['UploadedFile'])) {

                    $base64String = $file['UploadedFile'];

                    // Check if the base64 string has the prefix and remove it
                    if (strpos($base64String, 'base64,') !== false) {
                        $base64String = explode('base64,', $base64String)[1]; // Get the actual base64 data
                    }
            
                    // Decode the base64 string into binary data
                    $binaryImage = base64_decode($base64String);
            
                    if ($binaryImage === false) {
                        die("Error decoding base64 image"); // If decoding fails
                    }
                    // Store in ChildDocuments
                    $documentData = [
                        'OriginalName' => $file['OriginalName'],
                        'FileType' => $file['FileType'],
                        'UploadedFile' => $binaryImage,
                        'UploadDate' => date('Y-m-d H:i:s'),
                        'ChildID' => $ChildID
                    ];
                    $childdocumentModal->insert($documentData);
                }
            }
        }

        if(!empty($data['documents'])){
            foreach ($data['documents'] as $existingdocument) {
                // Check if this existing image's ImageID is present in the $images array
                $found = false;
            
                foreach ($files as $file) {
                    // Compare ImageID from the images array to the existing ImageID in the database
                    if (isset($file['FileID']) && $existingdocument->FileID === $file['FileID']) {
                        $found = true;
                        break; // Exit the loop early if a match is found
                    }
                }
            
                // If the ImageID from the database is not found in the $images array, delete it
                if (!$found) {
                    $childdocumentModal->delete($existingdocument->FileID , "FileID");
                }
            }
        }

        redirect("Child/ChildProfile");
    
    }    
}