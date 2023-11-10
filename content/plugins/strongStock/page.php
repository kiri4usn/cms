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
$pb = $page->addPageButton("Склад", "content/plugins/strongStock/page.php?p=0");
$pb .= $page->addPageButton("Приход", "content/plugins/strongStock/coming.php",'ajaxSend();');
$pb .= $page->addPageButton("Добавить SKU", "content/plugins/strongStock/SKU.php");
$page->alert(0, "Внeматочно следите за <p>остатком товара!!!!!</>");
$page->pagename('Тонкий склад', $pb);


?>

<div style="max-height: 495px !important; overflow: auto; overflow-y: visible; padding: 0px; margin: 30px; border-radius: 5px;">

<?php

$table = new tables;
$table->createTable('thisTable', '', 'padding: 0; margin: 0;');
$table->createThead('');
$table->openTheadTr();
$table->createTd('Артикул');
$table->createTd('Название');
$table->createTd('Цена');
$table->createTd('Остаток');
$table->createTd('Поставщик');
$table->createTd('Действие');
$table->closeTr();
$table->closeThead();


if($_GET['p'] == 0) {
    $result = mysqli_query(DBCon, "SELECT * FROM `product` WHERE `post_type` LIKE 'productP'");
} else {
    if ($_GET['p'] == 1) {
        $result = mysqli_query(DBCon, "SELECT * FROM `product` WHERE `post_type` LIKE 'productPF'");
    } else {
        if($_GET['p'] == 2){
            $result = mysqli_query(DBCon, "SELECT * FROM `product` WHERE `post_type` LIKE 'product'");
        } else {
            if($_GET['p'] == 3){
                $result = mysqli_query(DBCon, "SELECT * FROM `product` WHERE `post_type` LIKE 'Upacovka'");
            }
        }
    }
}

while ($row = $result->fetch_assoc()){
    $table->openTr();
    $table->createTd($row['ID'], 'width: 100px', '','stockUpdate('.$row['ID'].')');
    $table->createTd($row['post_title'], '','','stockUpdate('.$row['ID'].')');
    $table->createTd(($row['price']/100)." руб.", 'width: 100px','','stockUpdate('.$row['ID'].')');
    $table->createTd(($row['Qty']/1000)." кг/л", 'width: 100px','', 'stockUpdate('.$row['ID'].')');
    $table->createTd($row['vendor'],'width: 200px', '','stockUpdate('.$row['ID'].')');
    $table->createTd('
    <a class="bluecol" onclick="loadpage(\'content/plugins/strongStock/SKU.php?id='.$row['ID'].'\');">Изменить</a><a> | </a>
    <a class="redcol" onclick="loadpage(\'content/plugins/strongStock/SKU.php?newdoc&id='.$row['ID'].'\')">Расход</a>
    ','width: 200px;');
    //$table->createTd("<p class='bluecol' onclick='loadpage(\"content/plugins/strongStock/SKU.php?id=".$row['ID']."\");'>Изменить</p>",'width: 200px;color: gray');
    $table->closeTr();
}
$table->closeTable();
?>
</div>

<?php

$form  = new forms;
$form->openform("NOMETHOD", 'NOACTION', 'thisForm');
$form->name_label("Уделка");
$form->info_label('Менять сие значение может только администратор');
$form->info_label("? %%");

printf('<br>');

$form->name_label("Добавил");
$form->info_label("?");

printf('<br>');

$form->name_label("Средний расход / неделя");
$form->info_label('?');

printf('<br>');

$form->name_label("Используеимость");
$form->info_label('?');
$form->closeform();
