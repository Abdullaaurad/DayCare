<?php

    namespace Modal;

    defined('ROOTPATH') or exit('Access Denied!');

    class Report{
        use Modal;

        protected $table = 'monthly_reports';
        protected $allowedColumns = [
            'StudentID',
            'Month',
            'Year',
            'Status',
            'Submitted_at'
           
        ];

    
    }
?>