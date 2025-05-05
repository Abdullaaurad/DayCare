<?php

    namespace Modal;

    defined('ROOTPATH') or exit('Access Denied!');

    class Activity{
        use Modal;

        protected $table = 'activity';
        protected $allowedColumns = [
            'WorkID',
            'TeacherID',
            'Description',
            'CreatedBy',
            'CreatedAt',
            'UpdatedBy',
            'UpdatedAt'
        ];

        public function validate($data){
            $this->errors = [];

            if(empty($this->errors)){
                return true;
            }
            return false;
        }

        public function deleteTask($id, $id_column = 'ActivityID') {
            $data[$id_column] = $id;
            $query = "DELETE FROM $this->table WHERE $id_column = :$id_column";
    
            // var_dump($query);
            // exit();
    
            // Execute the query and check the result
            $result = $this->query($query, $data);
    
            // Return true if rows were affected, otherwise false
            return $result ? true : false;
    }
    }
?>