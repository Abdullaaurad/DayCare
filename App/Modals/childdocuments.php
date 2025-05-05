<?php

namespace Modal;

defined('ROOTPATH') or exit('Access Denied!');

class ChildDocuments {
    use Modal;

    protected $table = 'child_medication_documents';
    protected $allowedColumns = [
        'OriginalName',
        'FileType',
        'UploadedFile',
        'UploadDate',
        'ChildID'
    ];

    public function saveMedicationDocuments($childID, $file) {
            $imageBlob = file_get_contents($file['tmp_name']);
            $fileName = $file['name'];  // Get the original file name
            $fileType = $file['type'];  // Get the MIME type (e.g., image/png, application/pdf)
            $data = [
                'OriginalName' => $fileName,  // Store original file name
                'FileType' => $fileType,      // Store file type
                'UploadedFile' => $imageBlob, 
                'UploadDate' => date('Y-m-d H:i:s'), 
                'ChildID' => $childID
            ];
            $this->insert($data);
        }
    }        
?>
