<?php

namespace Modal;

defined('ROOTPATH') or exit('Access Denied!');

class Behaviour{
    use Modal;

    protected $table = 'behaviours';
    protected $allowedColumns = [
        'ChildID',
        'Description',
        'AssigneeID',
        'BehaviourID',
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

?>
