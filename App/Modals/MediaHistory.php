<?php

namespace Modal;

defined('ROOTPATH') or exit('Access Denied!');

class MediaHistory {
    use Modal;

    protected $table = 'mediahistory';
    protected $allowedColumns = [
        "MediaID",
        "ChildID",
        "DateTime",
        "Progress",
        "HistoryID"
    ];
}
