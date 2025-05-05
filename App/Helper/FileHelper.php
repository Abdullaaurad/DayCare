<?php

namespace App\Helpers;

class FileHelper {
    public static function store_file($file, $uploadDir = '') {

        if (empty($uploadDir)) {
            $uploadDir = 'Funzone/';
        } else {
            $uploadDir = $uploadDir . '/';  // Use '.' for string concatenation, not '+'
        }
    
        // Create the directory if it doesn't exist
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
    
        $fileSize = $file['size']; // File size
        $fileExt = pathinfo($file['name'], PATHINFO_EXTENSION); // File extension
        $originalFileName = $file['name']; // Original file name
        $uniqueFileName = uniqid('file_', true) . '.' . $fileExt; // Unique file name
        $filePath = $uploadDir . $uniqueFileName; // Full path for the uploaded file
    
        // Move the uploaded file to the desired directory
        if (move_uploaded_file($file['tmp_name'], $filePath)) {
            // Base URL to access the uploaded file
            $baseURL = "http://localhost/KiddoVille-UI_UX/Public/";
    
            // Return an array with file details
            return [
                'name' => $originalFileName,
                'url' => $baseURL . $filePath,
                'size' => $fileSize,
                'format' => $fileExt
            ];
        }
    
        // Return false if the file upload failed
        return false;
    }    
}
