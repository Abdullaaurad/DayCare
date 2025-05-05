<?php

    namespace Modal;

    defined('ROOTPATH') or exit('Access Denied!');

    class Chat{
        use Modal;

        protected $table = 'chat';
        protected $allowedColumns = [
            'SenderID',
            'ReceiverID',
            'Message',
            'URL',
            'FileType',
            'FileName',
            'SenderRole',
            'ReceiverRole',
            'DateTime',
            'Deleted',
            'Edited',
            'Seen'
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