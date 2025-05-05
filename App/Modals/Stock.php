<?php

    namespace Modal;

    defined('ROOTPATH') or exit('Access Denied!');

    class Stock{
        use Modal;

        protected $table = 'Stock';
        protected $allowedColumns = [
            'ItemID',
            'Item',
            'Category',
            'Quantity',
            'MinQuantity',
            'Stock',
            'Image',
            'ImageType',
            'Description',
            'Price'
        ];

        public function validate($data){
            $this->errors = [];

            if (!isset($data['Quantity']) || !is_numeric($data['Quantity']) || $data['Quantity'] < 0) {
                $this->errors['Quantity'] = "Quantity must be a non-negative number.";
            }

            if (!isset($data['MinQuantity']) || !is_numeric($data['MinQuantity']) || $data['MinQuantity'] < 0) {
                $this->errors['MinQuantity'] = "Minimum Quantity must be a non-negative number.";
            }

            if (!empty($data['Image']) && !in_array($data['ImageType'], ['image/jpeg', 'image/png', 'image/jpg'])) {
                $this->errors['Image'] = "Only JPG and PNG image types are allowed.";
            }

            if (!empty($data['Description']) && strlen($data['Description']) > 500) {
                $this->errors['Description'] = "Description cannot exceed 500 characters.";
            }

            return empty($this->errors);
        }

    }
