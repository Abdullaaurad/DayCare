<?php

    namespace Modal;

    defined('ROOTPATH') or exit('Access Denied!');

    class Skill{
        use Modal;

        protected $table = 'skills';
        protected $allowedColumns = [
            'SkillId',
            'Skill_Name',
           
        ];

    
    }
?>