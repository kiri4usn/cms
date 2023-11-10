<?php
require_once '../../../settings.php';
require_once '../../functions/page.php';
require_once '../../functions/forms.php';
require_once '../../functions/tables.php';


$page = new page;
$page->alert(0,"<p>Внимательно заполняй!</p> ошибки за тебя никто исправлять не будет!");

$pb = $page->addPageButton("Cклад", "content/plugins/strongStock/page.php?p=0");
$pb .= $page->addPageButton("Приход", "content/plugins/strongStock/coming.php", 'ajaxSend();');
$pb .= $page->addPageButton("Добавить SKU", "content/plugins/strongStock/SKU.php?");
$page->pagename('Приход', $pb);

$form = new forms;

$form->openform("NOMETHOD", "NOACTION", "thisForm");
$form->name_label('Номер накладной');
$form->info_label('Три раза перепроверь номер накладной!!!');
$form->input('invoice', 'Номер накладной', 'input');

printf("<br>");

$form->input('product', 'Название продукта','input');

printf("<div id='sTable'><div id='selectProduct'>");

printf("</div></div><br><br>");

$table = new tables;
$table->createTable('thisTable', 'xtable', 'padding: 0; margin: 0;');
$table->createThead('');
$table->openTheadTr();
$table->createTd('Артикул', 'width: 70px; background: #363636; padding:10px;');
$table->createTd('Название', 'min-width: 100px; background: #363636; padding:10px;');
$table->createTd('Остаток', 'width:100px; background: #363636; padding:10px;');
$table->createTd('Колличество', 'background: #363636; padding:10px; width:100px');
$table->createTd('Поставщик', 'min-width: 100px; background: #363636; padding:10px;');
$table->createTd('Удалить', 'background: #363636; padding:10px; width:100px');
$table->closeTr();
$table->closeThead();
$table->closeTable();
$form->send_form_custom('tof3(); loadpage(&quot;content/plugins/strongStock/page.php?p=0&quot;);');
