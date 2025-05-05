<?php

    namespace Modal;

    defined('ROOTPATH') or exit('Access Denied!');

    class ChildMedication{
        use Modal;

        protected $table = 'child_medication_images';
        protected $allowedColumns = [
            'MedicationImage',
            'DateAdded',
            'ChildID',
            'ImageType'
        ];

        public function saveMedicationImages($childID, $uploadedFiles) {
            foreach ($uploadedFiles as $file) {
                $imageBlob = file_get_contents($file['tmp_name']);
                $data = [
                    'MedicationImage' => $imageBlob,
                    'DateAdded' => date('Y-m-d H:i:s'),
                    'ChildID' => $childID,
                    'ImageType' => $file['type']
                ];
                $this->insert($data);
            }
        }

    }
?>