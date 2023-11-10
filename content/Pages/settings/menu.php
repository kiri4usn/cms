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
$page->pagename('Настойки меню', $pb);

$form = new forms;
$form->openform('post', '?', 'thisForm');
$form->name_label('Порядок меню');
$form->info_label('Сдесь вы можете установить свой порядок меню<br>По умолчанию он устанавливается в порядке установки страниц<br><br>');

$result = mysqli_query(DBCon, "SELECT * FROM `pages` ORDER BY `pages`.`id` ASC");
while($row = $result->fetch_assoc()){
    $form->name_label($row['name']);
    $form->input('page', $row['Porder'], 'input');
}
$form->send_form();