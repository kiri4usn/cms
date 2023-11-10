<?php

class BS260_Driver implements cont_plg_info{
    public function name(){
        return 'B-Smart BS260 web Driver';
    }
    public function version(){
        return '0.0.1';
    }
    public function plg_type(){
        return 'Print service';
    }
    public function visible(){
        return 1;
    }
}
