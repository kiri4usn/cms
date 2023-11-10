<?php

require_once '../../../settings.php';


$list = scandir('../../functions/');
foreach($list as $fnc_name){
    if(is_file('../../functions/'.$fnc_name)) {
        require_once '../../functions/' . $fnc_name;

        $fnc_name = mb_substr($fnc_name, 0 ,-4);
        $fnc = $fnc_name;
        $plg_info = new $fnc;
        $plg_info->public_interface();
        //var_dump($plg_info->public_interface());
    }
}

$page = new page;
$pb = '';
$pb .= $page->addPageButton('Переменные','content/plugins/BS260_Driver/variable.php');
$page->pagename('Настройка BS260', $pb);
$form = new forms;
$form->openform('post', 'content/plugins/BS260_Driver/settings.php','thisForm');
$form->name_label('IP адрес принтера');
$form->info_label('Желательно присвоить статический ip в <br>настройках роутера');
$form->input('ip', '192.168.123.123', 'input');
$form->send_form();