<style>
    body{
        background: rgba(15,24,40,1) !important;
    }

    .category {
        width: 120px;
        height: 120px;
        color: white;
        font-weight: 600;
        text-align: center;
        display: inline-flex;
        vertical-align: middle;
        margin: 2px;
        background: rgb(26, 26, 26);
    }

    .category .content {
        margin: auto;
    }

    .product {
        width: 120px;
        height: 120px;
        color: white;
        font-weight: 600;
        text-align: center;
        display: inline-flex;
        background: rgb(75, 75, 75);
        margin: 2px;
        vertical-align: middle;
    }

    .product .content {
        margin: auto;
    }

    .product2 {
        width: 120px;
        height: 120px;
        color: white;
        font-weight: 600;
        text-align: center;
        display: inline-flex;
        background: rgb(26, 26, 26);
        margin: 2px;
    }

    .product2 .content {
        margin: auto;
    }
</style>

<?php

require_once '../../../settings.php';
require_once 'fnc.php';


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
$page->alert(1, "Удачных продаж! 🎉");
$pb .= $page->addPageButton('X-отчет', '?');
$page->pagename('Касса', $pb);

$form = new forms;
$form->openform('post', '','thisForm', 'min-height: calc(100%% - 190px);max-height: calc(100%% - 190px); width: calc(100%% - 230px) !important;');
//$form->name_label('УПС! 🙃');
//$form->info_label(' Страница еще не готова');



$kassir = new kassir;
printf("<div id='toDel2' style='display: inline-block; width: calc(100%% - 500px); vertical-align: top; overflow: auto; overflow-y: visible; max-height: calc(100%% - 190px);'></div>");
printf("<div id='toDel' style='max-width: 496px; display: inline-block; vertical-align: top; overflow: auto; overflow-y: visible; max-height: calc(100%% - 190px);'>");
$result = mysqli_query(DBCon, "SELECT * FROM `product` WHERE `post_type` LIKE 'catalog' AND `post_parent` LIKE '0' AND `visible` != 0");
while ($row = $result->fetch_assoc()){
    $kassir->createCategory($row['post_title'], $row['ID'], $row['style']);
}

printf("</div>");

$form->closeform();
printf("<div style='z-index: 90; position: fixed; top:175px; right: 0; background: #f3f3f3; border-radius: 10px; padding: 20px;'>");
printf('<div class="product2"><p class="content">Итого<br>1240 руб</p></div><br>');
printf('<div class="product2" onclick="loadpage(\'content/plugins/Ekassir/finOrder.php\')"><p class="content">Продолжить</p></div><br>');
printf('<div class="product2"><p class="content" onclick="">Ожидание 60мин</p></div><br>');
printf('<div class="product2"><p class="content" onclick="claerCart()">Аннулировать заказ</p></div>');
printf("</div>");