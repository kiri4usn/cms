<?php

require_once '../../../settings.php';
require_once '../../functions/page.php';
require_once '../../functions/forms.php';
require_once '../../functions/tables.php';

$table = new tables;

$page = new page;
$page->alert(1,'Добавить новый товар');
$pb = $page->addPageButton("Весь склад", "content/plugins/fatStock/page.php?p=0");
$pb .= $page->addPageButton("Добавить Продукт", "content/plugins/fatStock/ProductAdd.php");
$page->pagename('Конструктор', $pb);

$forms = new forms();
$forms->openform('NOMETHOD', 'NOACTION', 'thisForm');

printf("<p style='color: #E0946C; font-size: 40px'>1 ШАГ</p><br>");

$forms->name_label('Наименование');
$forms->info_label('Название должно быть понятным как вам, так и остальным людям!<br>Мешанина - плохое название, суп гороховыйи - хорошее!');
$forms->input('nameF', '', 'input');

$forms->name_label('Краткое описание');
$forms->info_label('Так же понятно, как и название.<br>Поэмы тут писать не надо. Кратко, четко и понятно!');
$forms->input('about', '', 'input');

$forms->name_label('Категория');
$forms->info_label('Тут уж, наверное, и сами разберетесь');
$result = mysqli_query(DBCon, "SELECT * FROM `product` WHERE `post_type` LIKE 'catalog' AND `visible` = 1");
$options = '';
while ($row = $result->fetch_assoc()) {
    $options .= $forms->optinon($row['post_title'], $row['ID']);
}
$forms->select($options,'catalog');

$forms->closeform();

printf("<br><br>");

$forms->openform('NOMETHOD', 'NOACTION', 'thisForm');
printf("<p style='color: #E0946C; font-size: 40px'>2 ШАГ</p><br>");

$forms->name_label("Технологическая карта");
$forms->info_label("Необходимо точно ввести расход! Прям грамм к грамму!!<br>Коррекция будет доступна только в ввиде акта проработки! И то не факт)))");
printf('<div id="forAjax"></div>');


