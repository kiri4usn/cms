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
$page->alert(0, "Меняйте и настраивайте только в случае если <p>знаете, что делаете!</p>");
$page->pagename('Переменные', $pb);

$form = new forms;
$form->openform('post', 'content/plugins/BS260_Driver/settings.php','thisForm');
$form->name_label('УПС! 🙃');
$form->info_label(' Страница еще не готова');