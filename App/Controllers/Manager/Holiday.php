<?php

namespace Controller;
use App\Helpers\ManagerHelper;

use Modal\Modal;

defined('ROOTPATH') or exit('Access denied');

class Holiday
{
    use MainController;
    public function index()
    {
        $Helper = new ManagerHelper;
        $Helper->Check_Manager();
        $data = $this->show_holidays();
        $this->view('Manager/publish_holiday/Holiday', $data);
    }

    public function addleave()
    {
        $model = new \Modal\Holiday;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'Leave_Type' => $_POST['Leave_Type'],
                'About' => $_POST['About'],
                'Date' => $_POST['Date']
            ];

            if ($model->validate($data)) {
                $result = $model->insert($data);
                if ($result) {
                    echo "Holiday added successfully";
                } else {
                    echo "Failed to add holiday.";
                }


                header("Location: " . ROOT . "/Manager/Holiday");
            } else {
                $this->view('Manager/publish_holiday/Holiday');
            }
        }
    }

    public function show_holidays()
    {
        $data = [];
        $ShowHolidayModel = new \Modal\Holiday;
        $HolidayRecords = $ShowHolidayModel->findall();
        $data['allholidays'] = $HolidayRecords;
        return $data;
    }

    public function deleteholiday($HolidayID)
    {
        $model = new \Modal\Holiday;
        if ($model->delete($HolidayID,"HolidayID")) {
            echo "Successfully deleted";
        } else {
            echo "Failed to delete";
        }
        header("Location: " . ROOT . "/Manager/Holiday");
        exit();
    }

    public function updateholiday($HolidayID)
    {
        $model = new \Modal\Holiday;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'Leave_Type' => $_POST['Leave_Type'],
                'About' => $_POST['About'],
                'Date' => $_POST['Date']
            ];

            // Change this line - instead of passing $HolidayID as a string,
            // pass it as an array with the primary key name as the key
            $idArray = ['HolidayID' => $HolidayID]; // Assuming 'HolidayID' is your primary key name

            if ($model->update($idArray, $data)) {
                echo "Successfully updated";
            } else {
                echo "Failed to update";
            }
            header("Location: " . ROOT . "/Manager/Holiday");
            exit();
        } else {
            $holiday = $model->findAll($HolidayID);
            if ($holiday) {
                $this->view('Manager/publish_holiday/updateholiday', ['holiday' => $holiday]);
            } else {
                echo "Holiday not found.";
            }
        }
    }
}
