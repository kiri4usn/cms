<?php

//require_once '../../settings.php';
class auth{
    public function public_interface(){
        if(empty($_COOKIE['token'])){
            header("Location: login.php");
        }
    }

}