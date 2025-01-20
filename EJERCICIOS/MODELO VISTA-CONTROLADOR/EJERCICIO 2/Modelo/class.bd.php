<?php

    class bd{
        private $con;

        public function __construct(){
            require_once('../../../../cred.php');

            $this->con = new mysqli('localhost', USU_CON, PSW_CON, 'escuela');
        }
    }

?>