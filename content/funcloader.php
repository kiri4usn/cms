<?php

function func_loader(){
    $list = scandir('../functions/');
    foreach($list as $fnc_name){
        if(is_file('../functions/'.$fnc_name)) {
            require_once '../functions/' . $fnc_name;

            $fnc_name = mb_substr($fnc_name, 0 ,-4);
            $fnc = $fnc_name;
            $plg_info = new $fnc;
            $plg_info->public_interface();
            //var_dump($plg_info->public_interface());
        }
    }
}