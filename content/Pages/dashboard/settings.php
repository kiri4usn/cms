<?php
require_once '../../functions/forms.php';
require_once '../../functions/page.php';
require_once '../../functions/tables.php';
require_once '../../../settings.php';
//require_once '../../functions/metro.php';

$page = new page;
$page->alert(1, "Настроечки горящих позиций (проработка/прогонка) и многое другое");
$pb = $page->addPageButton("Дашборд", 'content/pages/dashboard.php');
$page->pagename('Настройки и тд', $pb);


$forms = new forms2;
$forms1 = new forms;
$table = new tables;
$forms1->openform("NOMETHOD", 'NOACTION', 'thisForm');

$table->createTable('thisTable','thisTable', 'padding:0; width: 450px');
$table->createThead('');
$table->openTheadTr();
$table->createTd('План продаж по дням', '', 'colspan="7"');
$table->closeThead();
$table->openTr();
$table->createTd('ПН');
$table->createTd('ВТ');
$table->createTd('СР');
$table->createTd('ЧТ');
$table->createTd('ПТ');
$table->createTd('СБ');
$table->createTd('ВС');
$table->closeTr();

$table->openTr();
$table->createTd($forms->input('d1', 'ПН', 'input',false, '', 'width: 40px;'));
$table->createTd($forms->input('d2', 'ВТ', 'input',false, '', 'width: 40px;'));
$table->createTd($forms->input('d3', 'СР', 'input',false, '', 'width: 40px;'));
$table->createTd($forms->input('d4', 'ЧТ', 'input',false, '', 'width: 40px;'));
$table->createTd($forms->input('d5', 'ПТ', 'input',false, '', 'width: 40px;'));
$table->createTd($forms->input('d6', 'СБ', 'input',false, '', 'width: 40px;'));
$table->createTd($forms->input('d7', 'ВС', 'input',false, '', 'width: 40px;'));
$table->closeTr();
$table->createTd($forms->send_form_custom(), '', 'colspan="7"');
$table->closeTable();

printf("<br><br>");

$result = mysqli_query(DBCon, "SELECT * FROM `product` WHERE `firePosition` = 1");
$table->createTable('thisTable','thisTable', 'padding:0; width: 450px');
$table->createThead('');
$table->openTheadTr();
$table->createTd('Горящие позиции');
$table->closeThead();
$i = 1;
while ($row = $result->fetch_assoc()){
    $table->openTr();
    $table->createTd($i." ".$row['post_title']);
    $table->closeTr();
    $i++;
}

$table->openTr();
$table->createTd("<strong>Добавить позицию  </strong><i onclick='addFirePosition();' class='fa-solid fa-plus'></i>");
$table->closeTr();

$forms1->closeform();