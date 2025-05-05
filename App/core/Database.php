<?php
    namespace Modal;

    defined('ROOTPATH') or exit('Access denied');

    Trait Database {

        // private function connect(){
        //     $string = "mysql:host=mysql-abdullaaurad.alwaysdata.net;dbname=abdullaaurad_my_db";
        //     //"mysql:hostname=".DBHOST.";dbname=".DBNAME;
        //     $con = new \PDO($string, "387928_abdulla", "yunus2017");
        //     //new \PDO($string,DBUSER,DBPASS);
        //     return $con;
        // }

        private function connect() {
            // Update the connection string to use localhost
            $string = "mysql:host=" . DBHOST . ";dbname=" . DBNAME;
        
            // Use the constants defined for DBUSER and DBPASS
            try {
                $con = new \PDO($string, DBUSER, DBPASS);
                // Set the PDO error mode to exception for better error handling
                $con->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $e) {
                // Handle the error, for example logging the error or displaying a message
                echo "Connection failed: " . $e->getMessage();
                return null;  // Or handle it differently as needed
            }
        
            return $con;
        }
        

        public function query($query, $data=[]){
            $con = $this->connect();
            $stm = $con->prepare($query);
            $check = $stm->execute($data);
            if($check){
                $result = $stm->fetchAll(\PDO::FETCH_OBJ);
                if(is_array($result) && count($result)){
                    return $result;
                }
            }
            return false;
        }

        public function get_row($query, $data=[]){
            $con = $this->connect();
            $stm = $con->prepare($query);

            $check = $stm->execute($data);
            if($check){
                $result = $stm->fetchAll(\PDO::FETCH_OBJ);
                if(is_array($result) && count($result)){
                    return $result[0];
                }
            }

            return false;
        }
    }
?>