<?php

    namespace Controller;

use PDO;

    class UsageReport{
        use MainController;

        public function index(){
            $session = new \Core\Session;
            $session->check_login();

            $data = $this->store_stats();
            $data['Top'] = $this->Top_Users();
            $data['Used'] = $this->Top_Used();
            $data['Users'] = $this->get_users();

            $this->view('Inventory/UsageReport', $data);
        }

        public function Usage_Report(){
            $StockModal = new \Modal\Stock;
            $InventoryModal = new \Modal\Inventory;
            $TeacherModal = new \Modal\Teacher;
            $MaidModal = new \Modal\Maid;
            $ReceptionistModal = new \Modal\Receptionist;
            $ManagerModal = new \Modal\Manager;
            $UserModal = new \Modal\User;

            header('Content-Type: application/json');
            $requestData = json_decode(file_get_contents("php://input"), true);

            $firstDate = $requestData['firstDate'] ?? null;
            $lastDate = $requestData['lastDate'] ?? null;
            $UserID = $requestData['UserID'] ?? null;
            $UserID = ($UserID === 'null' || $UserID === 'All') ? null : $UserID;
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

            $Tarnsactions = $InventoryModal->findall();
            foreach($Tarnsactions as $row){
                $Item = $StockModal->first(["ItemID" => $row->ItemID]);
                $row->Item = $Item->Item;
                $row->Category = $Item->Category;

                $User = $UserModal->first(["UserID" => $row->UserID]);
                switch ($User->Role) {
                    case 'Teacher':
                        $Persondata = $TeacherModal->first(["UserID" => $row->UserID]);
                        break;
                    case 'Maid':
                        $Persondata = $MaidModal->first(["UserID" => $row->UserID]);
                        break;
                    case 'Receptionist':
                        $Persondata = $ReceptionistModal->first(["UserID" => $row->UserID]);
                        break;
                    case 'Manager':
                        $Persondata = $ManagerModal->first(["UserID" => $row->UserID]);
                        break;
                }
                $row->Role = $User->Role;
                $row->Name = $Persondata->First_Name . ' ' . $Persondata->Last_Name;

                $Allowed = true;
                if(($firstDate != null) && ($firstDate >= $row->Date)){
                    $Allowed = false;
                }
                if(($lastDate != null) && ($lastDate <= $row->Date)){
                    $Allowed = false;
                }
                if(($UserID != null) && ($UserID !=$row->UserID)){
                    $Allowed = false;
                }
                if(($Category != null) && ($Category != $row->Category)){
                    $Allowed = false;
                }
                if($Allowed == true){
                    $data[] = $row;
                }

                $row->Date = date('Y-M-d', strtotime($row->Date));
            }

            $Data['data'] = $data;
            $Data['Count'] = ceil(count($data)/5);
            $Data['data'] = array_slice($data, $offset, $itemsPerPage);
            if($Data['Count'] < $Pagination ){
                $Data['Pagination'] = 1;
            }else{
                $Data['Pagination'] = $Pagination;
            }

            echo json_encode($Data);
        }

        public function Get_All(){
            $StockModal = new \Modal\Stock;
            $InventoryModal = new \Modal\Inventory;
            $TeacherModal = new \Modal\Teacher;
            $MaidModal = new \Modal\Maid;
            $ReceptionistModal = new \Modal\Receptionist;
            $ManagerModal = new \Modal\Manager;
            $UserModal = new \Modal\User;

            header('Content-Type: application/json');
            $requestData = json_decode(file_get_contents("php://input"), true);

            $firstDate = $requestData['firstDate'] ?? null;
            $lastDate = $requestData['lastDate'] ?? null;
            $UserID = $requestData['UserID'] ?? null;
            $UserID = ($UserID === 'null' || $UserID === 'All') ? null : $UserID;
            $Category = $requestData['Category'] ?? null;
            $Category = ($Category === 'null' || $Category === 'All') ? null : $Category;

            $data = [];

            $Tarnsactions = $InventoryModal->findall();
            foreach($Tarnsactions as $row){
                $Item = $StockModal->first(["ItemID" => $row->ItemID]);
                $row->Item = $Item->Item;
                $row->Category = $Item->Category;

                $User = $UserModal->first(["UserID" => $row->UserID]);
                switch ($User->Role) {
                    case 'Teacher':
                        $Persondata = $TeacherModal->first(["UserID" => $row->UserID]);
                        break;
                    case 'Maid':
                        $Persondata = $MaidModal->first(["UserID" => $row->UserID]);
                        break;
                    case 'Receptionist':
                        $Persondata = $ReceptionistModal->first(["UserID" => $row->UserID]);
                        break;
                    case 'Manager':
                        $Persondata = $ManagerModal->first(["UserID" => $row->UserID]);
                        break;
                }
                $row->Role = $User->Role;
                $row->Name = $Persondata->First_Name . ' ' . $Persondata->Last_Name;

                $Allowed = true;
                if(($firstDate != null) && ($firstDate >= $row->Date)){
                    $Allowed = false;
                }
                if(($lastDate != null) && ($lastDate <= $row->Date)){
                    $Allowed = false;
                }
                if(($UserID != null) && ($UserID !=$row->UserID)){
                    $Allowed = false;
                }
                if(($Category != null) && ($Category != $row->Category)){
                    $Allowed = false;
                }
                if($Allowed == true){
                    $data[] = $row;
                }

                $row->Date = date('Y-M-d', strtotime($row->Date));
            }

            $Data['data'] = $data;
            echo json_encode($Data);
        }

        private function Top_Used(){
            $StockModal = new \Modal\Stock;
            $InventoryModal = new \Modal\Inventory;

            $firstday = date("Y-m-01");
            $lastday = date("Y-m-t");
            $Issued = $InventoryModal->findFutureDatesWithConditions($firstday, $lastday, ["Activity" => "Issued"]);

            foreach($Issued as $row){
                $uniqueItemIDs[$row->ItemID] = true;
            }
            $uniqueItemIDList = array_keys($uniqueItemIDs);

            foreach($uniqueItemIDList as $unique){

                $ItemData = [
                    'ItemID'   => $unique,
                    'Issued'   => 0
                ];

                $Transactions = $InventoryModal->where_order_desc(["ItemID" => $unique, "Activity"=> "Issued"],[], "Date");
                foreach($Transactions as $tr){
                    $ItemData['Issued'] += $tr->Quantity;
                }

                $ItemDetails = $StockModal->first(["ItemID" => $unique]);
                $ItemData['Name'] = $ItemDetails->Item;
                $ItemData['Category'] = $ItemDetails->Category;
                $Data[] = $ItemData;
            }

            usort($Data, function($a, $b) {
                return $b['Issued'] <=> $a['Issued'];
            });
            $Data = array_slice($Data, 0, 5);

            return $Data;
        }

        private function store_stats(){
            $StockModal = new \Modal\Stock;
            $InventoryModal = new \Modal\Inventory;
        
            $data = [
                "Issued" => 0,
                "Returned" => 0,
                "Active" => 0
            ];

            $firstday = date("Y-m-01");
            $lastday = date("Y-m-t");

            $Issued = $InventoryModal->findFutureDatesWithConditions($firstday, $lastday, ["Activity" => "Issued"]);
            if(!empty($Issued)){
                foreach($Issued as $row){
                    $data['Issued'] += $row->Quantity;
                }
            }

            $Returned = $InventoryModal->findFutureDatesWithConditions($firstday, $lastday, ["Activity" => "Returned"]);
            if(!empty($Returned)){
                foreach($Returned as $row){
                    $data['Returned'] += $row->Quantity;
                }
            }

            $Active = $InventoryModal->findFutureDates($firstday, $lastday);
            $uniqueUserIDs = [];
            
            if (!empty($Active)) {
                foreach ($Active as $row) {
                    $uniqueUserIDs[$row->UserID] = true;
                }
            }
            $uniqueUserIDList = array_keys($uniqueUserIDs);
            $uniqueCount = count($uniqueUserIDList);
            $data['Active'] = $uniqueCount;

            return $data;
        }

        private function get_users(){
            $InventoryModal = new \Modal\Inventory;
            $userModal = new \Modal\User;
            $TeacherModal = new \Modal\Teacher;
            $MaidModal = new \Modal\Maid;
            $ReceptionistModal = new \Modal\Receptionist;
            $ManagerModal = new \Modal\Manager;
        
            $uniqueUserIDs = [];
            $rows = $InventoryModal->findall();
        
            foreach($rows as $row){
                $uniqueUserIDs[$row->UserID] = true;
            }
        
            $uniqueUserIDList = array_keys($uniqueUserIDs);
        
            $Data = [];
            foreach($uniqueUserIDList as $Person){
                $userData = [
                    'UserID'   => $Person,
                    'Name'   => ''
                ];

                $User = $userModal->first(["UserID" => $Person]);
                switch ($User->Role) {
                    case 'Teacher':
                        $Persondata = $TeacherModal->first(["UserID" => $Person]);
                        break;
                    case 'Maid':
                        $Persondata = $MaidModal->first(["UserID" =>  $Person]);
                        break;
                    case 'Receptionist':
                        $Persondata = $ReceptionistModal->first(["UserID" =>  $Person]);
                        break;
                    case 'Manager':
                        $Persondata = $ManagerModal->first(["UserID" =>  $Person]);
                        break;
                }
                
                $userData['Name'] = $Persondata->First_Name . ' ' . $Persondata->Last_Name;
                $Data[] = $userData;
            }

            return $Data;
        }

        private function Top_Users() {
            $InventoryModal = new \Modal\Inventory;
            $userModal = new \Modal\User;
            $TeacherModal = new \Modal\Teacher;
            $MaidModal = new \Modal\Maid;
            $ReceptionistModal = new \Modal\Receptionist;
            $ManagerModal = new \Modal\Manager;
        
            $firstday = date("Y-m-01");
            $lastday = date("Y-m-t");
            $uniqueUserIDs = [];
            $rows = $InventoryModal->findFutureDates($firstday, $lastday);
        
            foreach($rows as $row){
                $uniqueUserIDs[$row->UserID] = true;
            }
        
            $uniqueUserIDList = array_keys($uniqueUserIDs);
        
            $Data = [];
            foreach($uniqueUserIDList as $Person){
                $userData = [
                    'UserID'   => $Person,
                    'Issued'   => 0,
                    'Returned' => 0,
                    'Count'    => 0,
                ];
        
                $Issued = $InventoryModal->where_norder(["UserID" => $Person, "Activity" => "Issued"]);
                if ($Issued) {
                    foreach ($Issued as $Issue) {
                        $userData['Issued'] += $Issue->Quantity;
                        $userData['Count'] += 1;
                    }
                }
        
                $Returned = $InventoryModal->where_norder(["UserID" => $Person, "Activity" => "Returned"]);
                if ($Returned) {
                    foreach ($Returned as $Return) {
                        $userData['Returned'] += $Return->Quantity;
                        $userData['Count'] += 1;
                    }
                }

                $User = $userModal->first(["UserID" => $Person]);
                switch ($User->Role) {
                    case 'Teacher':
                        $Persondata = $TeacherModal->first(["UserID" => $Person]);
                        break;
                    case 'Maid':
                        $Persondata = $MaidModal->first(["UserID" =>  $Person]);
                        break;
                    case 'Receptionist':
                        $Persondata = $ReceptionistModal->first(["UserID" =>  $Person]);
                        break;
                    case 'Manager':
                        $Persondata = $ManagerModal->first(["UserID" =>  $Person]);
                        break;
                }
                
                $userData['Name'] = $Persondata->First_Name . ' ' . $Persondata->Last_Name;
                $Data[] = $userData;
            }

            usort($Data, function($a, $b) {
                return $b['Count'] <=> $a['Count'];
            });
            $Data = array_slice($Data, 0, 5);

            return $Data;
        }        
    }

?>