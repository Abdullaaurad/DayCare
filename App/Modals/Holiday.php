<?php

namespace Modal;

defined('ROOTPATH') or exit('Access Denied!');

class  Holiday{
    use \Modal\Modal;

    protected $table = 'holiday';   
    protected $allowedColumns = [
        'HolidayID',
        'Date',
        'Leave_Type',
        'About',
        'IsPublicHoliday'
    ];

    public function validate($data) {
        $this->errors = [];

        if (empty($data['Leave_Type'])) {
            $this->errors['Leave_Type'] = "Leave type is required.";
        }
        if (empty($data['Date'])) {
            $this->errors['Date'] = "Date is required.";
        }
        if (empty($data['About'])) {
            $this->errors['About'] = "Description is required.";
        }

        return empty($this->errors);
    }
}