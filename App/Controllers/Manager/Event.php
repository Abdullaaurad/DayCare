<?php

namespace Controller;
use App\Helpers\ManagerHelper;

defined('ROOTPATH') or exit('Access denied');

class Event
{
    use MainController;
    public function index()
    {
        $Helper = new ManagerHelper;
        $Helper->Check_Manager();
        $data = $this->show_events();
        $this->view('Manager/Event', $data);
    }


    public function addEvent()
    {
        $model = new \Modal\Event;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'EventName'   => $_POST['EventName'],
                'Date'        => $_POST['Date'],
                'Description' => $_POST['Description'],
            ];

            if ($model->validate($data)) {
                $result = $model->insert($data);

                if ($result) {
                    echo "Failed to add Event";
                } else {
                    echo "Event Added Successfully";
                }
                header("Location: " . ROOT . "/Manager/Event");
            } else {
                $this->view('Manager/Event');
            }
        }
    }


    public function show_events()
    {
        $data = [];
        $ShowEventsModel = new \Modal\Event;
        $EventsRecords = $ShowEventsModel->findall();
        $data['allevents'] = $EventsRecords;
        return $data;
    }

    public function deleteEvent($EventID)
    {
        $model = new \Modal\Event;
        if ($model->delete($EventID,"EventID")) {
            echo "Failed to delete event";
        } else {
            echo "Event Deleted Succesfully";
        }
        header("Location: " . ROOT . "/Manager/Event");
    }



    public function updateEvent($EventID)
    {
        $model = new \Modal\Event;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'EventName' => $_POST['EventName'],
                'EventDate' => $_POST['EventDate'],
                'Description' => $_POST['Description']
            ];

            // Change this line - instead of passing $HolidayID as a string,
            // pass it as an array with the primary key name as the key
            $idArray = ['EventID' => $EventID]; // Assuming 'HolidayID' is your primary key name

            if ($model->update($idArray, $data)) {
                echo "Successfully updated";
            } else {
                echo "Failed to update";
            }
            header("Location: " . ROOT . "/Manager/Event");
            exit();
        } else {
            $event = $model->findAll($EventID);
            if ($event) {
                $this->view('Manager/updateEvent', ['event' => $event]);
            } else {
                echo "Event not found.";
            }
        }
    }
}
