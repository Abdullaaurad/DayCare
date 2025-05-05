<?php

    namespace Modal;

    defined('ROOTPATH') or exit('Access Denied!');

    class Comment{
        use Modal;

        protected $table = 'comments';
        protected $allowedColumns = [
            'CommentText',
            'DateCommented',
            'Liked',
            'MediaID',
            "ChildID"
        ];

        public function validate($data){
            $this->errors = [];

            if(empty($this->errors)){
                return true;
            }
            return false;
        }
    }
?>