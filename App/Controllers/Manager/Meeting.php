<?php

namespace Controller;
use App\Helpers\ManagerHelper;

defined('ROOTPATH') or exit('Access denied');

class Meeting
{
    use MainController;
    public function index()
    {
        $Helper = new ManagerHelper;
        $Helper->Check_Manager();
        $data = $this->show_slots();
        $data = $data + $this->show_admission_slots();

        $this->view('Manager/Meeting', $data);
    }

    public function show_slots()
    {
        $data = [];
        $slotModel = new \Modal\Meeting;

        // $firstday = date('Y-m-d', strtotime('today'));
        // $lastday = date('Y-m-d', strtotime('+10 days'));
        // $slotRecords = $slotModel->findFutureDates($firstday, $lastday, 'Date');
        $slotRecords = $slotModel->findall();
        $data['allslots'] = $slotRecords;
        return $data;
    }

    public function show_admission_slots(){
        $data = [];
        $admissionModel = new \Modal\Meeting_Request;
        $slotRecords = $admissionModel->findall(); 
        $data['admission_allslots'] = $slotRecords;
        return $data;

    }

    public function updateMeeting()
    {
        $model = new \Modal\Meeting;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'Date' => $_POST['Date'],
                'Time' => $_POST['Time'],
                'MeetingID' => $_POST['MeetingID'],
            ];

            unset($data['MeetingID']);
            if ($model->validate($data)) {
                $result = $model->update(["MeetingID" => $_POST['MeetingID']], $data);

                if ($result) {
                    echo "Failed to update meeting";
                } else {
                    echo "Meeting Updated Successfully";
                }
                header("Location: " . ROOT . "/Manager/Meeting");
            } else {
                $this->view('Manager/Meeting');
            }
        }
    }

    public function checkDate()
    {
        $model = new \Modal\Meeting;
        $input = json_decode(file_get_contents("php://input"), true);
        $date = $input['Date'] ?? null;

        $allSlots = [
            "09:00:00",
            "09:15:00",
            "09:30:00",
            "09:45:00",
            "10:00:00",
            "10:15:00",
            "11:00:00",
            "11:15:00",
            "11:30:00",
            "11:45:00"
        ];

        // Get used slots from DB for this date
        $usedMeetings = $model->where_norder(["Date" => $date]);

        if (!empty($usedMeetings)) {
            $usedSlots = array_map(function ($meeting) {
                return $meeting->Time;
            }, $usedMeetings);
            $availableSlots = array_diff($allSlots, $usedSlots);
        } else {
            $availableSlots = $allSlots;
        }

        echo json_encode(array_values($availableSlots));
    }

    public function addMeeting()
    {
        $model = new \Modal\Meeting;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'Date' => $_POST['Date'],
                'Time' => $_POST['Time'],
            ];

            if ($model->validate($data)) {
                $result = $model->insert($data);

                if ($result) {
                    echo "Failed to add meeting";
                } else {
                    echo "Meeting Added Successfully";
                }
                redirect("Manager/Meeting");
            } else {
                $this->view('Manager/Meeting');
            }
        }
    }

    public function deleteSlot($MeetingID)
    {
        $model = new \Modal\Meeting;
        if ($model->delete($MeetingID, "MeetingID")) {
            echo "Slot Deleted Successfully";
        } else {
            echo "Failed to delete Slot";
        }
        header("Location: " . ROOT . "/Manager/Meeting");
    }
 

    // public function deleteAdmissionSlot($NIC){
    //     $model = new \Modal\Meeting_Request;
    //     if($model -> delete($NIC, "NIC")){
    //         echo "Slot Deleted Successfully";
    //     }else{  
    //         echo "Failed to delete Slot";
    //     }
    //     header("Location: " . ROOT . "/Manager/Meeting");
    // }


    


}
