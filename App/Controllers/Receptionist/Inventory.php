<?php

    namespace Controller;

    class Inventory{
        use MainController;

        public function index(){
            $session = new \Core\Session;
            $session->check_login();
            $data['Recent'] = $this->RecentActivities();
            $data['Stock'] = $this->LowStock();
            $data = $data + $this->store_stats();

            $this->view('Receptionist/Inventory', $data);
        }

        private function store_stats(){
            $data = [
                "Total" => 0,
                "Issued" => 0,
                "Low" => 0
            ];

            $StockModal = new \Modal\Stock;
            $InventoryModal = new \Modal\Inventory;

            $Stock = $StockModal->findall();
            foreach ($Stock as $row){
                $data['Total'] += $row->Quantity;
            }

            $All = $StockModal->getSortedData(["MinQuantity"=>"ASC",], "ASC");
            $Low = [];

            foreach ($All as $row){
                if($row->Quantity < $row->MinQuantity){
                    $Low[] = $row;
                }
            }
            $data['Low'] = count($Low);

            $startdate = new \DateTime(date("Y-m-01"));
            $lastdate = new \DateTime(date("Y-m-t"));

            $StockMonthIssued = $InventoryModal->findFutureDatesWithConditions($startdate, $lastdate, ["Activity" => "Issued"]);
            foreach ($StockMonthIssued as $row){
                $data['Issued'] += $row->Quantity;
            }
            $StockMonthReturned = $InventoryModal->findFutureDatesWithConditions($startdate, $lastdate, ["Activity" => "Returned"]);
            foreach ($StockMonthReturned as $row){
                $data['Issued'] -= $row->Quantity;
            }

            return $data;
        }

        private function RecentActivities(){
            $InventoryModal = new \Modal\Inventory;
            $UserModal = new \Modal\User;
            $MaidModal = new \Modal\Maid;
            $TeacherModal = new \Modal\Teacher;
            $ReceptionistModal = new \Modal\Receptionist;
            $StockModal = new \Modal\Stock;

            $All = $InventoryModal->getSortedData(["Date"=>"DESC", "Time"=>"DESC"], "DESC");
            $Data = array_slice($All, 0, 5);

            foreach ($Data as $row){
                $UserID = $row->UserID;
                $User = $UserModal->first(["UserID" => $UserID]);
                $Role = $User->Role;

                $Item = $StockModal->first(["ItemID" => $row->ItemID]);
                $row->ItemName = $Item->Item;

                $PartnerData = '';
                switch ($Role) {
                    case 'Teacher':
                        $PartnerData = $TeacherModal->first(["UserID" => $UserID]);
                        break;
                    case 'Maid':
                        $PartnerData = $MaidModal->first(["UserID" => $UserID]);
                        break;
                    case 'Receptionist':
                        $PartnerData = $ReceptionistModal->first(["UserID" => $UserID]);
                        break;
                }

                $dateObj = new \DateTime($row->Date . ' ' . $row->Time);
                $formattedDateTime = $dateObj->format('M d, Y - h:i A');

                $row->DateTime = $formattedDateTime;
                $row->Name = $PartnerData->First_Name. ' ' . $PartnerData->Last_Name;
                $row->Role = $User->Role;
            }

            return $Data;
        }

        private function LowStock(){
            $StockModal = new \Modal\Stock;

            $All = $StockModal->getSortedData(["MinQuantity"=>"ASC",], "ASC");
            $Low = [];

            foreach ($All as $row){
                if($row->Quantity < $row->MinQuantity){
                    $row->lowPercentage = $row->Quantity/$row->MinQuantity;
                    $Low[] = $row;
                }
            }
            usort($Low, function ($a, $b) {
                return $a->lowPercentage <=> $b->lowPercentage;
            });

            $Data = array_slice($Low, 0, 5);

            return $Data;
        }
    }
?>