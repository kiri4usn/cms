<?php
require_once '../../../settings.php';
require_once '../../functions/page.php';
require_once '../../functions/forms.php';



$page = new page;
$page->alert(0,"<p>Внимательно заполняй!</p> ошибки за тебя никто исправлять не будет!");

$pb = $page->addPageButton("Cклад", "content/plugins/strongStock/page.php?p=0");
$pb .= $page->addPageButton("Приход", "content/plugins/strongStock/coming.php","ajaxSend();");
$pb .= $page->addPageButton("Добавить SKU", "content/plugins/strongStock/SKU.php?");
$page->pagename('Редактор SKU', $pb);
//$search = new search;
//$search->createSearchForm("SELECT * FROM `product` WHERE `post_title` REGEXP 'бл'", 'Поиск по названию');


$forms = new forms;

$forms->openform('NOMETHOD', 'content/plugins/strongStock/controller.php', 'thisForm');
if(!isset($_GET['id'])) {
    $forms->name_label("Название продукта");
    $forms->info_label("Название продукта необходимо писать ровно так же, как будет <br>написанно в накладной.");
    $forms->input('nameSP', 'Название продукда', 'input', true, 'content/plugins/strongStock/controller.php?f=productSearch', '', '', "list");
    printf('<datalist id="list"></datalist>');
    $forms->name_label("Поставшик");
    $forms->info_label('Поставщик');
    $forms->input('vendor', "OOO Академия еды", 'input');

    $forms->name_label("Артикул поставщика");
    $forms->info_label('Тот, который указан в накладной');
    $forms->input('article', "2343465", 'input');

    $forms->name_label('Цена');
    $forms->info_label('Цена за кг или литр');
    $forms->input('price', 'Цена', 'input');

    $forms->name_label("Вес/объем");
    $forms->info_label('Сколько в упаковке продукта');
    $forms->input('Qty', 'Вес/объем', 'input');

    $forms->send_form_custom("addSKU1()");
    $forms->closeform();
} else {
    if(!isset($_GET['newdoc'])) {
        $result = mysqli_query(DBCon, "SELECT * FROM `product` WHERE `ID` = " . $_GET['id']);
        $row = $result->fetch_assoc();
        $forms->name_label("Название продукта");
        $forms->info_label("Название продукта необходимо писать ровно так же, как будет <br>написанно в накладной.");
        $forms->input('nameSP', $row['post_title'], 'input', '', '', '', '', '', $row['post_title']);
        $forms->name_label("Поставшик");
        $forms->info_label('Поставщик');
        $forms->input('vendor', $row['vendor'], 'input', '', '', '', '', '', $row['vendor']);

        $forms->name_label("Артикул поставщика");
        $forms->info_label('Тот, который указан в накладной');
        $forms->input('article', $row['article'], 'input', '', '', '', '', '', $row['article']);

        $forms->name_label('Цена');
        $forms->info_label('Цена за кг или литр');
        $forms->input('price', $row['price'], 'input', '', '', '', '', '', $row['price']);

        $forms->name_label("Вес/объем");
        $forms->info_label('Сколько в упаковке продукта');
        $forms->input('Qty', $row['Qty'], 'input', '', '', '', '', '', $row['Qty']);

        $forms->send_form_custom("editSKU1(" . $_GET['id'] . ")");
        $forms->closeform();
    } else {
        $result = mysqli_query(DBCon, "SELECT * FROM `product` WHERE `ID` = " . $_GET['id']);
        $row = $result->fetch_assoc();

        $forms->name_label('Основание');
        $forms->info_label('Основание расхода');
        $optinon = $forms->optinon("Списание", "Списание");
        $optinon .= $forms->optinon("Целевое списание", "Целевое списание");
        $optinon .= $forms->optinon("Списание по порче", "Списание по порче");
        $forms->select($optinon, 'base');

        $forms->name_label("Название продукта");
        $forms->info_label("Название продукта необходимо писать ровно так же, как будет <br>написанно в накладной.");
        $forms->input('nameSP', $row['post_title'], 'input', '', '', '', 'readonly', '', $row['post_title']);

        $forms->name_label("Вес/объем");
        $forms->info_label('Колличество в граммах или миоллилитров');
        $forms->input('Qty', '', 'input', '');

        $forms->send_form_custom("consumption()");
        $forms->closeform();
    }
}

?>