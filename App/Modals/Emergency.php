<?php

namespace Modal;

defined('ROOTPATH') or exit('Access Denied!');

class Emergency {
    use Modal;

    protected $table = 'emergency';
    protected $allowedColumns = [
        'ChildID',
        'Description',
        'AssigneeID',
        'EmergencyID',
        'Date',
        'Time',
    ];

    public function validate() {
        $errors = [];

        if (empty($_POST['Description']) || !is_string($_POST['Description'])) {
            $errors['Description'] = "Description must be a valid string";
        }
        return $errors;
    }

}
