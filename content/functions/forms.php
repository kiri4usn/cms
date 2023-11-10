<?php


class forms{
    public function public_interface(){
    }
    public function openform($method, $actioin, $id, $style = ''){
        printf("<form method='".$method."' action='".$actioin."' id='".$id."' style='".$style."'>");
    }

    public function closeform(){
        printf("</form>") ;
    }

    public function name_label($content){
        printf("<label>".$content."</label><br>");
    }

    public function info_label($content){
        printf("<label class='infolabel'>".$content."</label><br>");
    }

    public function input($name, $placeholder, $type , $ajax = false, $ajaxOprion = '', $style = '', $readonly = '', $datalist = '', $value = ''){
        printf("<input name='".$name."' placeholder='".$placeholder."' type='".$type."' ajax='".$ajax."' ajaxoption='".$ajaxOprion."' style='".$style."' ".$readonly." list='".$datalist."' value='".$value."'></input><br>");
    }

    public function optinon($str, $value = ''){
        return "<option value='".$value."'>".$str."</option>";
    }

    public function select($options, $name = ''){
        printf("<select name='".$name."'>".$options."</select><br><br>");
    }

    public function send_form(){
        printf("<input type='submit' class='submit'></input>");
    }

    public function send_form_custom($onclick = ''){
        printf("<p style='width: 400px; text-align: center; background: lightgrey; border: 1px solid black; border-radius: 5px' onclick='".$onclick."'>Далее</p>");
    }

}

class forms2{
    public function public_interface(){
    }
    public function openform($method, $actioin, $id, $style = ''){
        return("<form method='".$method."' action='".$actioin."' id='".$id."' style='".$style."'>");
    }

    public function closeform(){
        return("</form>") ;
    }

    public function name_label($content){
        return("<label>".$content."</label><br>");
    }

    public function info_label($content){
        return("<label class='infolabel'>".$content."</label><br>");
    }

    public function input($name, $placeholder, $type , $ajax = false, $ajaxOprion = '', $style = '', $readonly = '', $datalist = ''){
        return("<input name='".$name."' placeholder='".$placeholder."' type='".$type."' ajax='".$ajax."' ajaxoption='".$ajaxOprion."' style='".$style."', ".$readonly." list='".$datalist."'></input><br>");
    }

    public function optinon($str , $value =''){
        return "<option value='".$value."'>".$str."</option>";
    }

    public function select($options, $name = ''){
        return("<select name='".$name."'>".$options."</select><br><br>");
    }

    public function send_form(){
        return("<input type='submit' class='submit'></input>");
    }

    public function send_form_custom($onclick = ''){
        return("<p style='width: 400px; text-align: center; background: lightgrey; border: 1px solid black; border-radius: 5px' onclick='".$onclick."'>Далее</p>");
    }

}