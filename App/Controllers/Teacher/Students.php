<?php

namespace Controller;

class Students {
    use MainController;

    public function index() {
        $student = new \Modal\Child;
        $teacher = new \Modal\Teacher;

        // $TeacherID = $this->findID();
        $TeacherID =  1;

        $row = $teacher->first(['TeacherID' => $TeacherID]);
        // show($row);
        // exit();
            $firstName = $row->First_Name;
            $lastName = $row->Last_Name ;
            $email =  $row->Email;
            $image= $row->Image;
            $base64Image = base64_encode($image);

            $TeacherInfo = [
                    'firstName' => $firstName,  
                    'lastName' => $lastName,
                    'email' => $email,
                    'image' => 'data:image/jpg;base64,' . $base64Image];

                // show($TeacherInfo);
                // exit();

        // ✨ Handle AJAX POST request (search or fetch all)
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'SearchRecord') {
            $stu_name = $_POST['stu_name'] ?? '';
            $stu_name = htmlspecialchars($stu_name, ENT_QUOTES, 'UTF-8');

            if (!empty($stu_name)) {
                $query = "SELECT * FROM child WHERE First_Name LIKE '%$stu_name%' OR Last_Name LIKE '%$stu_name%'";
                $result = $student->query($query);
            } else {
                // If search is empty, get all students
                $result = $student->findAll();
            }

            // Format and respond with JSON
            if (is_array($result)) {
                foreach ($result as $stud) {
                    $stud->DOB = $this->agecalculate($stud->DOB);
                    $year = date('y', strtotime($stud->EnrollDate));
                    $stud->ChildID = "KV".$year.str_pad($stud->ChildID, 4, '0', STR_PAD_LEFT);
                   
                    if (!empty($stud->Image)) {
                        $stud->Image = base64_encode($stud->Image);
                        
                    }
                }
                //formatting the Reg No
                foreach ($result as $item) {
                   
                }

                header('Content-Type: application/json');
                echo json_encode([
                    'students' => array_map(fn($student) => (array)$student, $result),
                    'message' => empty($result) ? 'No students found.' : '',
                    'teacher' => $TeacherInfo

                ]);
            } else {
                header('Content-Type: application/json');
                echo json_encode([
                    'students' => [],
                    'message' => 'No students found.',
                    'teacher' => $TeacherInfo
                ]);
            }
            exit();
        }

        // 🌼 If not AJAX, render full page with all students
        $students = $student->findAll();

        foreach ($students as $stud) {
            $stud->DOB = $this->agecalculate($stud->DOB);
        }

        $this->view('Teacher/Students', [
            'students' => $students,
            'message' => empty($students) ? 'No students found.' : '',
            'teacher' => $TeacherInfo,
            "Profile" => $this->Profile()
        ]);
    }

        private function Profile(){
        $session = new \core\Session;
        $UserID = $session->get('USERID');

        $TeacherModal = new \Modal\Teacher;
        $data = $TeacherModal->first(["UserID" => $UserID]);
        if (!empty($data)) {
            $imageData = $data->Image;
            $imageType = $data->ImageType;
            $base64Image = (!empty($imageData) && is_string($imageData))
                ? 'data:' . $imageType . ';base64,' . base64_encode($imageData)
                : null;
            $data->Image = $base64Image;
            $data->EmployeeID = 'EMP' . str_pad($data->UserID, 5, '0', STR_PAD_LEFT);
        }

        return $data;
    }

        public function Logout()
    {
        $session = new \core\Session();
        $session->logout();

        echo json_encode(["success" => true]);
        exit;
    }

    function agecalculate($dob) {
        $dobTimestamp = strtotime($dob);
        $currentTimestamp = time();
        $age = floor(($currentTimestamp - $dobTimestamp) / (60 * 60 * 24 * 365.25)); // leap years considered
        return $age;
    }

    public function addSkill(){
        $observe = new \Modal\Observation;
        $score = new \Modal\SkillScore;

        // $TeacherID = $this->findID(); 
        $TeacherID =  1;
        $observeArray = [];
        $today = date('Y-m-d');

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $arr = $_POST;
            // var_dump($arr);
            // exit();
            
            $stu_id = $arr['ChildID'];

            //removing the text in the stuID
            $stu_id = htmlspecialchars($stu_id, ENT_QUOTES, 'UTF-8');
            $stu_id = ltrim(substr($stu_id, 4),"0");
            $arr['ChildID'] = $stu_id;

            $teacher['TeacherID'] = $TeacherID;
            $arr = array_merge($teacher, $arr);
            // var_dump($arr);
            // exit();

            //observation table array
            $observeArray['StudentID'] = $arr['ChildID'];
            $observeArray['TeacherID'] = $arr['TeacherID'];
            $observeArray['Scored_Date'] = $today;

            if($observe->validate($arr)){
                // var_dump($arr);
                // exit();
                //insert an observation
                $observe->insert($observeArray);
                $result = $observe->where_norder(['StudentID' =>$arr['ChildID'], 'TeacherID' => $arr['TeacherID'], 'Scored_Date'=> $today]);
                
                //   var_dump($result);
                // exit();
                //insert skill score
                $this->skillScore(end($result)->id,array_slice($arr,2));
                redirect('Teacher/Students');
            } else{
                $this->view('Teacher/Students', ['errors' => $observe->errors]);
            }

            
            

            

            
           
        }

    }

    public function skillScore($ID,$array){

        $skill = new \Modal\Skill;
        $score = new \Modal\SkillScore;

        $observeID = $ID;
        $skillArray = $array;
        // var_dump($skillArray,$observeID);
        // exit();

        foreach ($skillArray as $key => $value) {

            $scoreArray = [];
            $scoreArray['ObservationID'] = $observeID;
            // var_dump($skillArray);
            // exit();
            $skillName = $skill->where_norder(['Skill_Name' => $key]);
           
            $skillID = $skillName[0]->SkillId;
            $scoreArray['SkillID'] = $skillID;
            $scoreArray['Score'] = $value;

            $score->insert($scoreArray);
            
        }
        
    }

    public function findID(){

        $teacher = new \Modal\Teacher;
        $session = new \Core\Session;

        $userID = $session->get('USERID'); 

        $row = $teacher->first(['UserID' => $userID]);
        $result = $row->TeacherID;

        return $result;


    }

    public function selectbyAge(){

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $student = new \Modal\Child;
            $teacher = new \Modal\Teacher;
    
            // $TeacherID = $this->findID();
            $TeacherID =  1;
    
            $row = $teacher->first(['TeacherID' => $TeacherID]);
            // show($row);
            // exit();
                $firstName = $row->First_Name;
                $lastName = $row->Last_Name ;
                $email =  $row->Email;
                $image= $row->Image;
                $base64Image = base64_encode($image);
    
                $TeacherInfo = [
                        'firstName' => $firstName,  
                        'lastName' => $lastName,
                        'email' => $email,
                        'image' => 'data:image/jpg;base64,' . $base64Image];
    

            $ageGroup = $_POST['age-group'] ?? '';

            if(!EMPTY($ageGroup)){

                $students = $student->findall();

                $group3_5 = [];
                $group6_9 = [];
                $group10_13 = [];

                foreach ($students as $stud) {
                    $stud->DOB = $this->agecalculate($stud->DOB);
                    if ($stud->DOB >= 3 && $stud->DOB <= 5) {
                        $group3_5[] = $student;
                        $this->view('Teacher/Students', [
                            'students' => $group3_5,
                            'message' => empty($group3_5) ? 'No students found.' : '',
                            'teacher' => $TeacherInfo
                        ]);
                    } elseif ($stud->DOB >= 6 && $stud->DOB <= 9) {
                        $group6_9[] = $student;
                        $this->view('Teacher/Students', [
                            'students' => $group6_9,
                            'message' => empty($group6_9) ? 'No students found.' : '',
                            'teacher' => $TeacherInfo
                        ]);
                    } elseif ($stud->DOB >= 10 && $stud->DOB <= 13) {
                        $group10_13[] = $student;
                        $this->view('Teacher/Students', [
                            'students' => $group10_13,
                            'message' => empty($group10_13) ? 'No students found.' : '',
                            'teacher' => $TeacherInfo
                        ]);
                    }
                }

                

            }
            
        }
       

      
    }

}
