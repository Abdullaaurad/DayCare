<?php

    namespace Controller;

    class AcademicReport{
        use MainController;

        public function index(){

            if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['report_id'])){

                $TeacherID =  1;
                $student = new \Modal\Child;
                $report =  new \Modal\Report;
                $attend =  new \Modal\Attendance;
                $mark =  new \Modal\Mark;
                $subject = new \Modal\Subject;
                $skill = new \Modal\Skill;
                $skillScore = new \Modal\SkillScore;
                $observ = new \Modal\Observation;
                $teacher = new \Modal\Teacher;

                $teacherDetails = $teacher->where_norder(['TeacherID' => $TeacherID]);
                $teacherDetails = $teacherDetails[0];
                $profilePic = $teacherDetails->Image;
                $base64Image = base64_encode($profilePic);
    
                $teacherInfo =[
                    'TeacherID' => $teacherDetails->TeacherID,
                    'First_Name' => $teacherDetails->First_Name,
                    'Last_Name' => $teacherDetails->Last_Name,
                    'Image' => 'data:image/jpg;base64,' . $base64Image
                ];

                
                $reportID = $_POST['report_id'];

                //report details
                $reports = $report->where_norder(['ReportID' => $reportID]);
                $reportCard = $reports[0];

                //student details
                $child = $student->where_norder(['ChildID' => $reportCard->StudentID]);
                $studentDetails = $child[0];
                // var_dump($studentDetails);
                // exit();
                
                //registarin no
                $studentDetails->DOB = $this->agecalculate($studentDetails->DOB);
                $year = date('y', strtotime($studentDetails->EnrollDate));
                $studentDetails->RegNo = "KV".$year.str_pad($studentDetails->ChildID, 4, '0', STR_PAD_LEFT);
                $profilePic = $studentDetails->Image;
                $base64Image = base64_encode($profilePic);
                // var_dump($profilePic);
                // exit();
                $studentData [] = [
                    'RegNo' => $studentDetails->RegNo,
                    'First_Name' => $studentDetails->First_Name,
                    'Last_Name' => $studentDetails->Last_Name,
                    'Age' => $studentDetails->DOB,
                    'Month' => $reportCard->Month,
                    'Created' => date('Y-m-d', strtotime($reportCard->Submitted_at)),
                    'Year' => $reportCard->Year,
                    'Image'=> 'data:image/jpeg;base64,' . $base64Image
                ];



                //attendance details

                $childID = $studentDetails->ChildID;
                $currentMonth = date('m'); // e.g. '04'
                $currentYear = date('Y');  // e.g. '2025'

                $query = "SELECT * FROM attendance WHERE ChildID = :childID 
                        AND MONTH(Start_Date) = :month 
                        AND YEAR(Start_Date) = :year";

                $attendances = $attend->query($query, [
                    'childID' => $childID,
                    'month' => $currentMonth,
                    'year' => $currentYear
                ]);

                // show($attendances);
                // exit();

                $attendData [] = [
                    'precentage' => round((count($attendances) / 30) * 100,1),
                    'precent' => count($attendances),
                    'absent' => 30 - count($attendances)
                ];


                //subject marks

                //find marks to the relavent reportID

                $month = date('F');
                $currentMonth = date('Y-m');

                $marks = $mark->where_norder(['Report_ID' => $reportID]);

                foreach ($marks as $mrk) {

                    $submittedDate = $mrk->Submitted_at;
                    $submittedMonth = date('Y-m', strtotime($submittedDate));
                    if ($submittedMonth == $currentMonth) {
                        $subjectDetails = $subject->where_norder(['Subject_ID' => $mrk->Subject_ID]);
                        if (isset($subjectDetails[0])) {
                            $subjectName = $subjectDetails[0]->Subject_Name;
                    
                            // Add the subject and marks information to the marksData array
                            $marksData[] = [
                                'Subject_ID' => $mrk->Subject_ID,
                                'Subject_Name' => $subjectName,
                                "Mark" => $mrk->Marks
                            ];
                        }
                    } 
                    
                    

                  
                }
                // var_dump($marksData);
                // exit();
                if (empty($attendData)) {
                    $attendError = "Attendance data is missing or incomplete.";
                } else {
                    $attendError = null;  
                }
                
                // Check if the student data is available
                if (empty($studentData)) {
                    $studentError = "Student data is missing or incomplete.";
                } else {
                    $studentError = null;  
                }
                
                // Check if the marks data is available
                if (empty($marksData)) {
                    $marksError = "Marks data is missing or incomplete.";
                } else {
                    $marksError = null;  
                

                //skill score details

                $observations = $observ->where_norder(['StudentID' => $reportCard->StudentID]);
                $skillsData = [
                    'cognitive' => 0,
                    'communication' => 0,
                    'critical_thinking' => 0,
                    'emotional_control' => 0,
                    'creativity' => 0
                ];
                $skillRounds = [
                    'cognitive' => 0,
                    'communication' => 0,
                    'critical_thinking' => 0,
                    'emotional_control' => 0,
                    'creativity' => 0
                ];
                foreach ($observations as $obs) {
                    $scores = $skillScore->where_norder(['ObservationID' => $obs->id]);

                    foreach ($scores as $score) {
                        if($score->SkillID == 1){
                            $skillsData['cognitive'] = $skillsData['cognitive'] + $score->Score;
                            $skillRounds['cognitive'] = $skillRounds['cognitive'] + 1;
                        }
                        if($score->SkillID == 2){
                            $skillsData['communication'] =$skillsData['communication'] + $score->Score;
                            $skillRounds['communication'] = $skillRounds['communication'] + 1;
                        }
                        if($score->SkillID == 3){
                            $skillsData['critical_thinking'] =  $skillsData['critical_thinking'] + $score->Score;
                            $skillRounds['critical_thinking'] = $skillRounds['critical_thinking'] + 1;
                        }
                        if($score->SkillID == 4){
                            $skillsData['emotional_control'] = $skillsData['emotional_control'] + $score->Score;
                            $skillRounds['emotional_control'] = $skillRounds['emotional_control'] + 1;
                        }
                        if($score->SkillID == 5){
                            $skillsData['creativity'] = $skillsData['creativity'] + $score->Score;
                            $skillRounds['creativity'] = $skillRounds['creativity'] + 1;
                        }
                        
                    }
                   
                };

                foreach ($skillsData as $skill => $totalScore) {
                    $count = $skillRounds[$skill];
                    $skillsData[$skill] = $count > 0 ? round($totalScore / $count, 2) : 0;
                }

                // var_dump($skillsData);
                // exit();
               

                

             
                
                
                $this->view('Teacher/AcademicReport',[
                    'attendData' => $attendData[0],
                    'studentData' => $studentData[0],
                    'marksData' => $marksData,
                    'skillsData' => $skillsData,
                    'attendError' => $attendError,  // Pass error for attendance
                    'studentError' => $studentError,  // Pass error for student
                    'marksError' => $marksError, 
                    'teacherInfo' => $teacherInfo
                ]);
            }

            // var_dump($_POST);
            // exit();
            
           
        }
    }

        function agecalculate($dob) {
            $dobTimestamp = strtotime($dob);
            $currentTimestamp = time();
            $age = floor(($currentTimestamp - $dobTimestamp) / (60 * 60 * 24 * 365.25)); // leap years considered
            return $age;
        }
    
    }
?>




