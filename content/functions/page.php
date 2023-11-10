<?php
class page{
    public function public_interface(){
        printf("");
    }
    public function addPageButton($str, $url, $onclick = ''){
        return ("<a onclick='loadpage(\"".$url. "\");".$onclick."'>".$str."</a>");
    }
    public function pagename($name, $pb = ''){
        //$class = $BlueOrRed=="blue"?'bluepage':'redpage';
        printf("<p class='pagename'>".$name.$pb."</p>");
    }

    public function alert($bool, $str){
        $class = $bool?'goodalert':'erralert';
        printf("<div class='".$class."'>".$str."</div>");
    }


}

