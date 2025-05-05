<?php

    namespace Modal;

    defined('ROOTPATH') or exit('Access Denied!');

    class SkillScore{
        use Modal;

        protected $table = 'skill_scores';
        protected $allowedColumns = [
            'ObservationID',
            'SkillID',
            'Score'

           
        ];

    
    }
?>