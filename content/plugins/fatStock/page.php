
<?php
require_once '../../../settings.php';
require_once '../../functions/tables.php';

/*
$page = new page;
$pb = $page->addPageButton("Весь склад", "content/plugins/fatStock/page.php?p=0");
$pb .= $page->addPageButton("Добавить Продукт", "content/plugins/fatStock/ProductAdd.php", 'ajaxSend();');
$page->alert(0, "Внeматочно следите за <p>остатком товара!!!!!</>");
$page->pagename('Толстый склад', $pb);


?>

<div style="margin: 30px; max-height: calc(100vh - 150px); overflow: auto; overflow-y: visible;box-shadow: 0px 5px 5px -5px rgba(34, 60, 80, 0.6);">

<?php

$table = new tables;
$table->createTable('thisTable', '', 'padding: 0; margin: 0;');
$table->createThead('');
$table->openTheadTr('background: #fff; color: black;');
$table->createTd('Имя');
$table->createTd('Артикул');
$table->createTd('Статус');
$table->createTd('Цена');
$table->createTd('Категория');
$table->createTd('Остаток');
$table->createTd('---');
$table->closeTr();
$table->closeThead();
*/


$result = mysqli_query(DBCon, "SELECT * FROM `product` WHERE `post_type` NOT LIKE 'productP' AND `visible` = 1;");

$i = 0;

$resultArray = array();
while ($row = $result->fetch_assoc()){

    array_push($resultArray, array(
        'post_parent' => $row['post_parent'],
            'ID' => $row['ID'],
        'post_title' => $row['post_title']
    ));
}

arsort($resultArray['post_parent']);

foreach ($resultArray as $arr){
    var_dump($arr);
    printf("<br>");
}
