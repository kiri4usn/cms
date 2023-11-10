<?php
class topbar{
    public function public_interface(){
        if(empty($_COOKIE['token']) && empty($_COOKIE['usr'])) {
            printf("<div id='adminbar'></div>");
        } else {
            printf("<div id='adminbar'><p class='sname'>".Sname."  (".Ver.")</p><p class='usr' onclick='modalProfile();'>".$_COOKIE['usr']."</p></div>");
        }
    }
}