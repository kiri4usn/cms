<?php
require_once '../funcloader.php';
require_once '../../settings.php';
require_once '../functions/metro.php';

func_loader();
$page = new page;
$pb = $page->addPageButton("Настройки", "content/pages/dashboard/settings.php");
$page->alert(1,"Удачных продаж");
$page->pagename( 'Дашборд', $pb);

$form = new forms;
$form->openform('post', 'content/plugins/BS260_Driver/settings.php','thisForm');
//$form->name_label('УПС! 🙃');
//$form->info_label(' Страница еще не готова');



$metro = new metro;

$form->name_label('Финансы на '.date('d.m.y').'<br>');

$metro->metro_p("Продаж ","Факт 0 руб.", 'План 41.100');
$metro->metro_p("Средний чек ","Факт 0 руб." ,'План 685');
$metro->metro_p("Колличество продаж ","Факт 0", 'План 50');



$form->name_label('<br><br>Сотрудники '.date('d.m.y').'<br>');
$metro->metro_p("Сотрудников в смене ","1");
$metro->metro_p("Начислено ЗП ","0 руб.");

$form->name_label('<br><br>Горящие позиции '.date('d.m.y').'<br>');

$result = mysqli_query(DBCon, "SELECT * FROM `product` WHERE `firePosition` = 1");
$i = 1;
while ($row = $result->fetch_assoc()) {
    $metro->metro_p('Позиция '.$i, mb_substr($row['post_title'], 0, 44), '', 'editFirePosition();');
    $i++;
}


$metro->metro_p('Добавить позицию', "<i onclick='addFirePosition();' class='fa-solid fa-plus'></i>", '', 'addFirePosition();');

$form->closeform();