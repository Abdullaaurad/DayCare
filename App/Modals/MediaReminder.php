<?php

namespace Modal;

defined('ROOTPATH') or exit('Access Denied!');

class MediaReminder {
    use Modal;

    protected $table = 'mediareminder';
    protected $allowedColumns = [
        "MediaID",
        "ChildID",
        "Date",
        "Time",
    ];
}
