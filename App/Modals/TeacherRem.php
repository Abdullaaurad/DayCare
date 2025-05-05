<?php

    namespace Modal;

    defined('ROOTPATH') or exit('Access Denied!');

    class TeacherRem{
        use Modal;

        protected $table = 'teacherleavebalance';
        protected $allowedColumns = [
            'id',
            'TeacherID ',
            'LeaveType',
            'TotalAllocated',
            'Used',
            'Remaining',
            'LastUpdate'
            
        ];

        public function allocateLeave($TeacherID){
            $query = "SELECT TotalAllocated From {$this->table} where TeacherID = :TeacherID";
            $params = [
                'TeacherID' => $TeacherID
            ];
            $result = $this->query($query, $params);
            if($result){
                return $result[0]['TotalAllocated'];
            }
            return false;
        }

        public function RemainingLeave($TeacherID){
            $query = "SELECT Remaining From {$this->table} where TeacherID = :TeacherID";
            $params = [
                'TeacherID' => $TeacherID
            ];
            $result = $this->query($query, $params);
            if($result){
                return $result[0]['Remaining'];
            }
            return false;
        }

        public function usedleave($TeacherID){
            $query = "SELECT Used From {$this->table} where TeacherID = :TeacherID";
            $params = [
                'TeacherID' => $TeacherID
            ];
            $result = $this->query($query, $params);
            if($result){
                return $result[0]['Used'];
            }
            return false;
        }

        
    }
?>