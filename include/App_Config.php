<?php
class App_Config{

    public $localhost;
    public $online;

    public function __construct(){
        $this->localhost = $_SERVER['SERVER_NAME']."/";
        //$this->online = "online domain";
    }

}


?>
