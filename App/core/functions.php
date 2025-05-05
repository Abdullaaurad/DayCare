<?php
    defined('ROOTPATH') or exit('Access denied');

    check_extensions();
    function check_extensions()
    {
        $required_extensions = [
            'gd',
            'mysqli',
            'pdo_mysql',
            'pdo_sqlite',
            'curl',
            'intl',
            'exif',
            'mbstring',
        ];

        $not_loaded = [];

        foreach ($required_extensions as $ext) {
            if (!extension_loaded($ext)) {
                $not_loaded[] = $ext;
            }
        };

        if (!empty($not_loaded)) {
            die("Please load the following extensions in your php.ini file: <br>" . implode("<br>", $not_loaded));
        };
    }

    function show($stuff)
    {
        echo "<pre>";
        print_r($stuff);
        echo "</pre>";
    }

    function esc($str)
    {
        return htmlspecialchars($str);
    }

    function redirect($path)
    {
        header("location: " . ROOT . "/" . $path);
        die;
    }

    function hashpassword($data)
    {
        return password_hash($data, PASSWORD_BCRYPT);
    }

    function checkpassword($textdata, $hashdata)
    {
        return password_verify($textdata, $hashdata);
    }

    /** load image. if not exist, load placeholder */
    function get_image(mixed $file = '', string $type = 'post'): string
    {
        $file = $file ?? '';
        if (file_exists($file)) {
            return ROOT . "/" . $file;
        }

        if ($type == "user") {
            return ROOT . "/assets/images/user.jpg";
        } else {
            return ROOT . "/assets/images/no_image.jpg";
        }
    }

    function get_pagination_vars(): array
    {
        $vars = [];
        $vars['page'] = $_GET['page'] ?? 1;
        $vars['page'] = (int)$vars['page'];
        $vars['prev_page'] = $vars['page'] <= 1 ? 1 : $vars['page'] - 1;
        $vars['next_page'] = $vars['page'] + 1;

        return $vars;
    }

    function message($msg = null, bool $clear = false)
    {
        $ses = new Core\Session();
        if (!empty($msg)) {
            $ses->set('message', $msg);
        }
        if (!empty($ses->get('message'))) {
            $msg = $ses->get('message');
            if ($clear) {
                $ses->pop('message');
            }
            return $msg;
        }
        return false;
    }

    function old_checked(string $key, string $value, string $default = ""): string
    {

        if (isset($_POST[$key])) {
            if ($_POST[$key] == $value) {
                return ' checked ';
            }
        } else {

            if ($_SERVER['REQUEST_METHOD'] == "GET" && $default == $value) {
                return ' checked ';
            }
        }

        return '';
    }


    function old_value(string $key, mixed $default = "", string $mode = 'post'): mixed
    {
        $POST = ($mode == 'post') ? $_POST : $_GET;
        if (isset($POST[$key])) {
            return $POST[$key];
        }

        return $default;
    }

    function old_select(string $key, mixed $value, mixed $default = "", string $mode = 'post'): mixed
    {
        $POST = ($mode == 'post') ? $_POST : $_GET;
        if (isset($POST[$key])) {
            if ($POST[$key] == $value) {
                return " selected ";
            }
        } else

    if ($default == $value) {
            return " selected ";
        }

        return "";
    }

    function get_date($date){
        return date("jS M, Y",strtotime($date));
    }

    define('UPLOADS_DIR', 'Uploads/');

    //Upload a file for a specific user and child.
    
    // @param int $userId The ID of the parent user.
    // @param int $childId The ID of the child (or null for parent-only files).
    // @param string $fileType The type of file (profile, medical, document).
    // @param array $file The file data from the form ($_FILES array).
    // @return string|bool The file path on success, or false on failure.

    function uploadFile($username, $childname = null, string $fileType, array $file) {

        // Define base directory structure
        $userDir = UPLOADS_DIR . $username . '/';
        $childDir = $childname ? $userDir . $childname . '/': null;

        if (!file_exists($userDir)) {
            mkdir($userDir, 0777, true);
            file_put_contents($userDir . "index.php", "Access Denied!"); // Prevent direct access
        }
    
        if ($childname && !file_exists($childDir)) {
            mkdir($childDir, 0777, true);
            file_put_contents($childDir . "index.php", "Access Denied!"); // Prevent direct access
        }
    
        // Determine the file path based on the type of file
        if ($fileType === 'profile') {
            // For the parent profile image, save it directly in the user directory
            if (!$childname) {
                // Parent's profile photo
                $filePath = $userDir . 'profile.jpg';
            } else {
                // Child's profile photo (named based on child)
                $filePath = $childDir . $childname . 'profile.jpg';
            }
        } else {
            // For other types of files (e.g., medical, documents), create respective subdirectories inside the child directory
            if ($childname) {
                $typeDir = $childDir . "$fileType/";
            } else {
                // If no child name is provided, files go to the parent directory
                $typeDir = $userDir . "$fileType/";
            }

            if (!file_exists($typeDir)) {
                mkdir($typeDir, 0777, true);
                file_put_contents($typeDir . "index.php", "Access Denied!"); // Prevent direct access
            }

            // Save the file in the appropriate subdirectory with its original name
            $filePath = $typeDir . basename($file['name']);
        }
    
        // Move the uploaded file to the determined path
        if (move_uploaded_file($file['tmp_name'], $filePath)) {
            return $filePath; // Return the file path on success
        }
        return false; // Return false if upload failed
    }

    function uploadFileURL($username, $childname = null, string $fileType, array $fileUrls) {
        // Define base directory structure
        $userDir = UPLOADS_DIR . $username . '/';
        $childDir = $childname ? $userDir . $childname . '/' : null;
    
        // Ensure the user directory exists
        if (!file_exists($userDir)) {
            mkdir($userDir, 0777, true);
            file_put_contents($userDir . "index.php", "Access Denied!"); // Prevent direct access
        }
    
        // Ensure the child directory exists
        if ($childname && !file_exists($childDir)) {
            mkdir($childDir, 0777, true);
            file_put_contents($childDir . "index.php", "Access Denied!"); // Prevent direct access
        }
    
        // Determine the file path based on the file type
        if ($fileType === 'profile') {
            // Profile image path
            if (!$childname) {
                $filePath = $userDir . 'profile.jpg'; // Parent's profile photo
            } else {
                $filePath = $childDir . $childname . 'profile.jpg'; // Child's profile photo
            }
        } else {
            // Other file types (documents, prescriptions)
            if ($childname) {
                $typeDir = $childDir . "$fileType/"; // Subdirectory for child files
            } else {
                $typeDir = $userDir . "$fileType/"; // Parent files
            }
    
            // Create directory if it doesn't exist
            if (!file_exists($typeDir)) {
                mkdir($typeDir, 0777, true);
                file_put_contents($typeDir . "index.php", "Access Denied!"); // Prevent direct access
            }
    
            // Create a list of file paths for each file URL
            $filePaths = [];
            foreach ($fileUrls as $fileUrl) {
                // Get the file name from the URL
                $fileName = basename($fileUrl);
                $filePaths[] = $typeDir . $fileName;
    
                // Download and save the file
                if (file_put_contents($typeDir . $fileName, file_get_contents($fileUrl)) === false) {
                    return false; // Return false if file download fails
                }
            }
            return $filePaths; // Return array of saved file paths
        }
    
        // If we only have a single file, return that file path
        return $filePath;
    }
    
    
    /**
     * Retrieve files of a specific type for a user or child.
     *
     * int $userId The ID of the parent user.
     * int|null $childId The ID of the child (or null for parent-only files).
     * string $fileType The type of file folder to retrieve from (e.g., profile, medication, document).
     * Array of file paths matching the criteria.
     */


    function retrieveFiles($username, $childname = null, string $fileType) {
        // Define base directory structure based on `uploadFile`
        $userDir = ROOT . '/' . UPLOADS_DIR . '/' . $username . '/';
        $childDir = $childname ? $userDir . $childname . '/' : $userDir;
        
        // Define the specific type directory path
        if ($fileType === 'profile') {
            // If the fileType is 'profile', look for profile files in user or child directories
            $typeDir = $childname ? $childDir : $userDir;
            $filePath = $typeDir . ($childname ? $childname . 'profile.jpg' : 'profile.jpg');
            
            // Check if the profile file exists and return it as a single-item array if found
            return file_exists($filePath) ? [str_replace(UPLOADS_DIR, '', $filePath)] : [];
        } else {
            // For other file types (e.g., medical, document), add type subdirectory
            $typeDir = $childDir . "$fileType/";
        }
    
        $files = [];
        if (file_exists($typeDir)) {
            // Retrieve all files in the type directory and strip the base upload directory
            foreach (glob($typeDir . "*") as $file) {
                $files[] = str_replace(UPLOADS_DIR, '', $file);
            }
        }
    
        return $files; // Return an array of file paths relative to UPLOADS_DIR
    }
    
    function getProfileImageUrl($username, $childname = null) {
        // Define base directory structure based on `uploadFile`
        $userDir = UPLOADS_DIR . $username . '/';
        $childDir = $childname ? $userDir . $childname . '/' : $userDir;
        
        // Determine the file path for the profile image
        $filePath = $childname ? $childDir . $childname . 'profile.jpg' : $userDir . 'profile.jpg';
        
        // Check if the profile file exists and return its absolute URL if found
        // if (file_exists($filePath)) {
            $relativePath = str_replace(UPLOADS_DIR, '', $filePath);
            return ROOT . '/Uploads/' . $relativePath; // Absolute URL
        // } else {
        //     // Return a default absolute image URL if no profile image is found
        //     return ROOT . '/Uploads/default_images/default_profile.jpg'; // Adjust this default path as needed
        // }
    }

    function getFilesByType($username, $childname, string $fileType) {
        // Define the base directory structure
        $userDir = UPLOADS_DIR . $username . '/';
        $childDir = $childname ? $userDir . $childname . '/' : null;
    
        // Determine the directory path based on the file type
        if ($childname) {
            $typeDir = $childDir . $fileType . "/";
        } else {
            $typeDir = $userDir . $fileType. "/";
        }
    
        // Check if the directory exists
        if (!is_dir($typeDir)) {
            show("file not exist");
            return []; // Return an empty array if the folder doesn't exist
        }
    
        // Scan the directory for files
        $files = array_diff(scandir($typeDir), ['.', '..', 'index.php']);
    
        // Append the full path to each file
        $filePaths = array_map(function($file) use ($typeDir) {
            return $typeDir . $file;
        }, $files);
    
        return $filePaths; // Return an array of file paths
    }
    
    
    //Delete a specific image from the user's or child's folder.

    function deleteImage(string $filePath) {
        // Check if the file exists before trying to delete it
        if (file_exists($filePath)) {
            return unlink($filePath); // Delete the file and return the result
        }
        return false; // Return false if the file doesn't exist
    }

    function renameDirectory($currentUsername, $newUsername, $currentChildname = null, $newChildname = null) {
        // Define base directory structure
        $currentUserDir = UPLOADS_DIR . $currentUsername . '/';
        $newUserDir = UPLOADS_DIR . $newUsername . '/';
    
        if (!file_exists($currentUserDir)) {
            return false; // Current user directory doesn't exist
        }
    
        // If renaming the parent folder
        if ($newUsername && $currentUsername !== $newUsername) {
            if (file_exists($newUserDir)) {
                return false; // New username directory already exists, avoid overwriting
            }
            // Rename parent directory
            if (!rename($currentUserDir, $newUserDir)) {
                return false; // Failed to rename
            }
            $currentUserDir = $newUserDir; // Update path for further operations
        }
    
        // If renaming a child folder
        if ($currentChildname && $newChildname && $currentChildname !== $newChildname) {
            $currentChildDir = $currentUserDir . $currentChildname . '/';
            $newChildDir = $currentUserDir . $newChildname . '/';
    
            if (!file_exists($currentChildDir)) {
                return false; // Current child directory doesn't exist
            }
    
            if (file_exists($newChildDir)) {
                return false; // New child directory already exists, avoid overwriting
            }
    
            // Rename child directory
            if (!rename($currentChildDir, $newChildDir)) {
                return false; // Failed to rename
            }
        }
    
        return true; // Rename successful
    }    

    function URL($key):mixed {

        $URL = $_GET['url'] ?? 'home';
        $URL = explode('/', trim($URL, "/"));
        return $URL;

        switch($key){
            case 'page':
            case 0:
                return $URL[0] ?? null;
                break;
            case 'section':
            case 'slug':
            case 1:
                return $URL[1] ?? null;
            case 'action':
            case 2:
                return $URL[2] ?? null;
                break;
            case 'id':
            case 3:
                return $URL[3] ?? null;
            default:
                return null;
                break;
        }
    }

    function checkRequiredFields($requiredFields, $data) {
        foreach ($requiredFields as $field) {
            if (empty($data[$field])) {
                return false;
            }
        }
        return true;
    }

    function IsString($string){
        if(ctype_alpha($string)){
            return true;
        }else{
            return false;
        }
    }

    function IsNumber($string){
        if(ctype_digit($string)){
            return true;
        }else{
            return false;
        }
    }

    function isEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) !== false) {
            return true;
        } else {
            return false;
        }
    }

    function agecalculate($dob) {
        $birthDate = new DateTime($dob);
        $today = new DateTime();
    
        // Check if the birth date is in the future
        if ($birthDate > $today) {
            return "Birthdate cannot be in the future";
        }
    
        // Calculate the age based on the difference in years and months
        $ageDiff = $today->diff($birthDate);
        $years = $ageDiff->y;
        $months = $ageDiff->m;
    
        // Ensure the age is between 2 and 12 years
        if ($years < 2) {
            return "Age must be at least 2 years";
        }
        if ($years > 12) {
            return "Age must be less than or equal to 12 years";
        }
    
        // Return the age as "X years and Y months"
        return "{$years} years {$months} months";
    }

    function lastSeen($timestamp) {
        // Convert the timestamp to a DateTime object
        $date = new DateTime($timestamp);
        $now = new DateTime();
    
        // Calculate the difference in days between the timestamp and now
        $daysDiff = (int)$date->diff($now)->format("%a");
    
        // Format based on the time of day and date difference
        if ($daysDiff === 0) {
            // Today: format as "today 8:15am"
            return "today " . $date->format("g:iA");
        } elseif ($daysDiff === 1) {
            // Yesterday: format as "yesterday 9:00pm"
            return "yesterday " . $date->format("g:iA");
        } else {
            // Older dates: format as "MM/DD 12:05pm"
            return $date->format("m/d g:iA");
        }
    }

    

    function genderconvert($data){
        if($data = 'M'){
            return 'Male';
        }
        else{
            return 'Female';
        }
    }
?>