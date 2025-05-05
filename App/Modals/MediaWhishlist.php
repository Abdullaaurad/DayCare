<?php

namespace Modal;

defined('ROOTPATH') or exit('Access Denied!');

class MediaWhishlist {
    use Modal;

    protected $table = 'mediawhishlist';
    protected $allowedColumns = [
        "MediaID",
        "ChildID",
        "Date",
        "Time",
        "Reminder"
    ];
}
