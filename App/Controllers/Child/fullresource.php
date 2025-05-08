<?php

    namespace Controller;

    defined('ROOTPATH') or exit('Access denied');

    class FullResource{
        use MainController;
        public function index(){
            $session = new \Core\Session;
             
            $session = new \Core\Session;
            $session->check_login();
            $session->check_child();
    
            $data = [];

            $data = $data + $this->store_resourse();
            $this->view('Child/fullresource', $data);
        }

        private function store_resourse(){
            $session = new \Core\Session;
             
            if (isset($_GET['MediaID'])) {
                $MediaID = $_GET['MediaID'];
                $MediaID = (int)$MediaID;

                $MediaModal = new \Modal\Media;
                $Media = $MediaModal->first(["MediaID" => $MediaID]);

                $imageData = $Media->Image;
                $imageType = $Media->ImageType;
                $base64Image = (!empty($imageData) && is_string($imageData)) 
                    ? 'data:' . $imageType . ';base64,' . base64_encode($imageData) 
                    : null;

                $Media->Image = $base64Image;

                $data['Media'] = $Media;
                return $data;
            }
        }
    }
?>