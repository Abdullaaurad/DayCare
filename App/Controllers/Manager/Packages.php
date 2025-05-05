<?php

namespace Controller;

use App\Helpers\ManagerHelper;

defined('ROOTPATH') or exit('Access denied');

class Packages
{
    use MainController;

    public function index()
    {
        $Helper = new ManagerHelper;
        $Helper->Check_Manager();
        $packages = new \Modal\Package;
        $result = $packages->findall();
        $data = ['packageData' => $result];
        //show($data);
        $this->view('Manager/Packages', $data);
    }

    public function addpackage()
    {
        $model = new \Modal\Package;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $features = isset($_POST['features']) ? $_POST['features'] : '';

            $data = [
                'Name' => $_POST['Name'],
                'Price' => $_POST['Price'],
                'Description' => $_POST['Description'],
                'AgeGroup' => $_POST['AgeGroup'],
                'FoodAddons' => $features == 'FoodAddons' ? 1 : 0,
                'AllHours' => $features == 'AllHours' ? 1 : 0,
                'Everything' => $features == 'Everything' ? 1 : 0,
                'Monday' => isset($_POST['Monday']) ? 1 : 0,
                'Tuesday' => isset($_POST['Tuesday']) ? 1 : 0,
                'Wednesday' => isset($_POST['Wednesday']) ? 1 : 0,
                'Thursday' => isset($_POST['Thursday']) ? 1 : 0,
                'Friday' => isset($_POST['Friday']) ? 1 : 0,
                'Saturday' => isset($_POST['Saturday']) ? 1 : 0,
                'Sunday' => isset($_POST['Sunday']) ? 1 : 0
            ];

            if ($model->validate($data)) {
                $result = $model->insert($data);
                if ($result) {
                    echo "Package Succecfully added";
                } else {
                    echo "Failed to add package";
                }


                redirect("Manager/Packages");
            } else {
                $this->view('Manager/publish_holiday/Holiday');
            }
        }
    }

    public function deletepackage($PackageID)
    {
        $model = new \Modal\Package;
        if ($model->delete($PackageID, "PackageID")) {
            echo "Succecfully deleted";
        } else {
            echo "Failed to delete";
        }

        header("Location: " . ROOT . "/Manager/Packages");
        exit();
    }


    public function updatepackage()
    {
        $model = new \Modal\Package;

        //show($_POST);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $features = isset($_POST['features']) ? $_POST['features'] : '';
             //show($_POST);
            $data = [
                'Name' => $_POST['Name'],
                'Price' => $_POST['Price'],
                'Description' => $_POST['Description'],
                'AgeGroup' => $_POST['AgeGroup'],
                'FoodAddons' => $features == 'FoodAddons' ? 1 : 0,
                'AllHours' => $features == 'AllHours' ? 1 : 0,
                'Everything' => $features == 'Everything' ? 1 : 0,
            ];

            //show($data);

            $id = $_POST['PackageID'];

            //$idArray = ['PackageID' => $id];

            $n = $model->update_withid($id, $data , 'PackageID'); ;
            show($n);

            // if($model->update($idArray, $data))
        //     {
        //         $_SESSION['message'] = "Package successfully updated";
        //         $_SESSION['message_type'] = "success";
        //         redirect("Manager/Packages");
        //     } else {
        //         // $_SESSION['message'] = "Failed to update package";
        //         $_SESSION['message_type'] = "error";
        //         redirect("Manager/Home");
        //     }

}
    }
        //     $idArray = ['PackageID' => $PackageID];

        //     if ($model->update($idArray, $data)) {
        //         $_SESSION['message'] = "Package successfully updated";
        //         $_SESSION['message_type'] = "success";
        //     } else {
        //         $_SESSION['message'] = "Failed to update package";
        //         $_SESSION['message_type'] = "error";
        //     }

        //     header("Location: " . ROOT . "/Manager/Packages");
        //     exit();
        // } else {
        //     echo "Invalid request!";
        // }
    

    public function getPackage($PackageID) {
        $pack = new \Modal\Package;
        $package = $pack->findById($PackageID);
        //show($package);
        if($package) {
            header('Content-Type: application/json');
            echo json_encode($package);
        } else {
            http_response_code(404);
            echo json_encode(["error" => "Package not found"]);
        }
}

}
