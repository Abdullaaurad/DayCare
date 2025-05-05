<?php

namespace Modal;

defined('ROOTPATH') or exit('Access Denied!');

class TaskCompletion {
    use Modal;

    protected $table = 'taskcompletion';
    protected $allowedColumns = [
        "TaskID",
        "ChildID",
        "DateTime",
        "Completed"
    ];
}
