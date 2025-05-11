<?php

namespace Controller;

class Inventory
{
    use MainController;

    public function index()
    {
        $session = new \Core\Session;
        $session->check_login();
        $data = [];

        $data['Borrowed'] = $this->Currently_Borrowed();
        $data = $data + $this->store_stats();
        $data['Profile'] = $this->profile();
        $this->view('Maid/Inventory', $data);
    }

    public function Usage_Report()
    {
        $StockModal = new \Modal\Stock;
        $InventoryModal = new \Modal\Inventory;

        header('Content-Type: application/json');
        $requestData = json_decode(file_get_contents("php://input"), true);

        $session = new \core\Session;
        $UserID = $session->get("USERID");
        $firstDate = $requestData['firstDate'] ?? null;
        $lastDate = $requestData['lastDate'] ?? null;
        $Category = $requestData['Category'] ?? null;
        $Category = ($Category === 'null' || $Category === 'All') ? null : $Category;
        $Pagination = $requestData['Pagination'] ?? 1;

        $itemsPerPage = 5;
        $offset = ($Pagination - 1) * $itemsPerPage;

        $Data = [
            "data" => [],
            'Pagination' => 1,
            'Count' => 1
        ];
        $data = [];

        $Tarnsactions = $InventoryModal->where_order_desc(["UserID" => $UserID], [], "Date");
        foreach ($Tarnsactions as $row) {
            $Item = $StockModal->first(["ItemID" => $row->ItemID]);
            $row->Item = $Item->Item;
            $row->Category = $Item->Category;

            $Allowed = true;
            if (($firstDate != null) && ($firstDate >= $row->Date)) {
                $Allowed = false;
            }
            if (($lastDate != null) && ($lastDate <= $row->Date)) {
                $Allowed = false;
            }
            if (($Category != null) && ($Category != $row->Category)) {
                $Allowed = false;
            }
            if ($Allowed == true) {
                $data[] = $row;
            }

            $row->Date = date('Y-M-d', strtotime($row->Date));
        }

        $Data['data'] = $data;
        $Data['Count'] = ceil(count($data) / 5);
        $Data['data'] = array_slice($data, $offset, $itemsPerPage);
        if ($Data['Count'] < $Pagination) {
            $Data['Pagination'] = 1;
        } else {
            $Data['Pagination'] = $Pagination;
        }

        echo json_encode($Data);
    }

    public function Currently_Borrowed()
    {
        $StockModal = new \Modal\Stock;
        $InventoryModal = new \Modal\Inventory;
        $session = new \core\Session;
        $UserID = $session->get("USERID");

        $Borrowed = $InventoryModal->where_order(["UserID" => $UserID, "Activity" => "Borrowed", "Returned" => 0], ["Date" => "ASC"]);
        if (!empty($Borrowed)) {
            foreach ($Borrowed as $row) {
                $Item = $StockModal->first(["ItemID" => $row->ItemID]);
                $row->Name = $Item->Item;
                $row->Category = $Item->Category;
                $row->ReturnDate = date('Y-m-d', strtotime($row->Date . ' +1 day'));

                $today = date('Y-m-d');
                if ($today == $row->Date) {
                    $row->Status = "Current";
                    $row->class = "status status-available";
                } else if ($row->ReturnDate == $today) {
                    $row->Status = "Due Soon";
                    $row->class = "status status-low";
                } else {
                    $row->Status = "Overdue";
                    $row->class = "status status-out";
                }
            }
        }

        return $Borrowed;
    }

    public function ReturnBorrowed()
    {
        $ActivityModal = new \Modal\Inventory;

        $activityIDsString = $_POST['activityIDs'] ?? '';
        $activityIDs = explode(',', $activityIDsString);

        foreach ($activityIDs as $id) {
            $ActivityModal->update_withid($id, ["Returned" => 1], "ActivityID");
        }
        redirect('Maid/Inventory');
    }

    private function Profile()
    {
        $session = new \core\Session;
        $UserID = $session->get('USERID');

        $MaidModal = new \Modal\Maid;
        $data = $MaidModal->first(["UserID" => $UserID]);
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

    public function store_stats()
    {
        $InventoryModal = new \Modal\Inventory;
        $session = new \core\Session;
        $UserID = $session->get("USERID");
        $Data = [
            "Use" => 0,
            "Overdue" => 0,
            "Request" => 0
        ];

        $Borrowed = $InventoryModal->where_norder(["UserID" => $UserID, "Activity" => "Borrowed", "Returned" => 0]);
        if (!empty($Borrowed)) {
            foreach ($Borrowed as $row) {
                $row->ReturnDate = date('Y-m-d', strtotime($row->Date . ' +1 day'));

                $today = date('Y-m-d');
                if ($today == $row->Date) {
                    $Data['Use'] += $row->Quantity;
                } else if ($row->ReturnDate == $today) {
                    $Data['Use'] += $row->Quantity;
                } else {
                    $Data['Overdue'] += $row->Quantity;
                }
            }
        }
        return $Data;
    }

    public function Pending_Request() {}
}
