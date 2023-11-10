<?php

class tables{
    public function public_interface(){
        printf('');
    }
    public function createTable($class, $id, $style = ''){
        printf('<table class="'.$class.'" id="'.$id.'" style="'.$style.'">');
    }
    public function createThead($id){
        printf('<thead class="showOrNoshowDark" id="'.$id.'">');
    }
    public function openTheadTr($style = ''){
        $style = $style==''?'':'style="'.$style.'"';
        printf('<tr '.$style.'>');
    }
    public function closeThead(){
        printf('</thead>');
    }
    public function openTr($onclick = '', $style = '', $class= ''){
        $style = $style==''?'':'style="'.$style.'"';
        $class = $class==''?'':'class="'.$class.'"';
        printf('<tr class="showOrNoshow" '.$style.' '.$class.' onclick="'.$onclick.'">');
    }
    public function closeTr(){
        printf('</tr>');
    }

    public function openTd($style){
        printf('<td style="'.$style.'">');
    }
    public function closeTd(){
        printf('</td>');
    }
    public function createTd($str, $style = '', $atribute = '', $onclick = ''){
        printf('<td style="'.$style.'" '.$atribute.' onclick="'.$onclick.'">'.$str.'</td>');
    }
    public function closeTable(){
        printf('</table>');
    }
}