<?php

    namespace Controller;

    class Prescriptions{
        use MainController;

        public function index(){
            // var_dump($_POST);
            // exit();
            
           $doctor = new \Modal\Doctor;
           $child = new \Modal\Child;
           $appoint = new \Modal\Appointment;
           $parent = new \Modal\ParentUser;
           $medical = new \Modal\ChildMedical;
           $docs = new \Modal\ChildDocuments;

           $DoctorID = $this->findID();

           if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST)){
            
                $apptInfo = $appoint->where_norder(['AppointmentID' => $_POST['SlotID']]);
                $childInfo = $child->where_norder(['ChildID' => $apptInfo[0]->ChildID]);
               
                //find paretn infromation
                $parents = $parent->first(['ParentID' => $childInfo[0]->ParentID]);
               
                //find previous medical info
                $medicals = $medical->where_norder(['ChildID' => $apptInfo[0]->ChildID]);
                // show($parents);
                // exit();

                $medications = [];
                if($medicals){
                    foreach($medicals as $med){
                        $medications[] = [
                            'name' => $med->Notes
                        ];
                    }
                }

               


                //find mediaction docs
                $documents = $docs->where_norder(['ChildID' => $apptInfo[0]->ChildID ]);
            
                $images = [];
                if($documents){
                    foreach($documents as $dox){
                        $docImage = $dox->UploadedFile;
                        $base64Image = base64_encode($docImage);
                        $images[] = [
                            'id'=> $dox->FileID,
                            'image' => 'data:image/jpeg;base64,' . $base64Image
                        ];
                    }
                }
                

                //doctor details

                $doctorInfo = $doctor->first(['DoctorID' => $DoctorID]);
                $profileImage = $doctorInfo->Image;
                $baseImage = base64_encode($profileImage);

                $doctorDetails = [
                    'id' => $DoctorID,
                    'Name' =>$doctorInfo->First_Name. ' ' . $doctorInfo->Last_Name,
                    'image' => 'data:image/jpeg;base64,' . $baseImage,
                    'date' => date('Y-m-d')   
                ];
               
                // show($doctorDetails);
                // exit();

                $childInfo[0]->SlotID = $_POST['SlotID'];
                $childInfo[0]->ParentName = $parents->First_Name.' '.$parents->Last_Name;
                $childInfo[0]->Contact = $parents->Phone_Number;
                $childInfo[0]->Medicals = $medications ? $medications : null;
                $childInfo[0]->Images = $images ?? null;
                // show($childInfo);
                // exit();

                if(!empty($childInfo) ){
                    // show($childInfo);
                    // exit();
                    $this->view('Doctor/Prescriptions',['child' => $childInfo[0], 'doctor' => $doctorDetails]);
                }else{
                    $this->view('Doctor/Prescriptions',['message' => 'No child found']);
                }

            
            
            
        }
    }

    public function getImage(){

        $docs = new \Modal\ChildDocuments;

    if (isset($_GET['id'])) {
        //show($_GET['id']);
        $image = $docs->first(['FileID' => $_GET['id']]);

        if ($image) {
            header("Content-Type: " . $image->FileType); 
            header('Content-Disposition: attachment; filename="medical_doc.jpg"'); 
            header('Content-Length: ' . strlen($image->UploadedFile));
            echo $image->UploadedFile;
            exit;

        } else {
            echo "Image not found.";
        }
    } else {
        echo "No image ID provided.";
    }
       
    }

    public function addPrescription(){

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $data = $_POST;
           
           $doctor = new \Modal\Doctor;
           $pres = new \Modal\Prescription;

           $DoctorID = $this->findID();

           $data['DoctorID'] = $DoctorID;

            
           $result = $pres->insert($data);
           if($result){
            $this->view('Doctor/Prescriptions', ['message' => 'Prescription not added']);
            }else{
                redirect('Doctor/Dashboard');
            }
        }
    }

        
        public function findID(){

            $doctor = new \Modal\Doctor;
            $session = new \Core\Session;
    
            $userID = $session->get('USERID'); 
            // var_dump($userID);
            // exit();
    
            $row = $doctor->first(['UserID' => $userID]);
            $result = $row->DoctorID;
    
            return $result;
    
    
        }
    }
?>