<?php
require_once '../../../settings.php';
require_once '../../functions/tables.php';
require_once '../../functions/tables.php';

printf("<div id='selectProduct'><br>");

$table = new tables;
$table->createTable('thisTable', '', 'padding: 0; margin: 0;');
$table->createThead('');
$table->openTheadTr();
$table->createTd('Артикул', 'width: 70px; background: #363636; padding:10px;');
$table->createTd('Название', 'min-width: 100px; background: #363636; padding:10px;');
$table->createTd('Остаток', 'min-width: 100px; background: #363636; padding:10px;');
$table->createTd('Поставщик', 'min-width: 100px; background: #363636; padding:10px;');
$table->createTd('Добавить', 'background: #363636; padding:10px; width:100px');
$table->closeTr();
$table->closeThead();

$name = $_GET['search'];
$result = mysqli_query(DBCon, "SELECT * FROM `product` WHERE `post_type` LIKE 'productP' AND `post_title` REGEXP '".$name."' OR `article` REGEXP '".$name."' ORDER BY `product`.`ID` ASC LIMIT 5;");
while ($row = $result->fetch_assoc()){
    $table->openTr();
    $table->createTd($row['article']);
    $table->createTd($row['post_title']);
    $table->createTd(($row['Qty']/1000)." кг/л");
    $table->createTd($row['vendor']);
    $table->createTd("<a class='bluecol' onclick='selectProduct(\"".$row['ID']."\", \"".$row['article']."\", \"".$row['post_title']."\", \"".($row['Qty']/1000)."\" , \"".$row['vendor']."\")'>Добавить</a>");
    $table->closeTr();
}
$table->closeTable();

/*
?>






<div id='selectProduct'><br>
<table style="width:100%; color: white;">
    <thead>
        <td style="min-width: 100px; background: #363636; padding:10px;">Артикул</td>
        <td style="min-width: 100px; background: #363636; padding:10px;">Название</td>
        <td style="min-width: 100px; background: #363636; padding:10px;">Остаток</td>
        <td style="min-width: 400px; background: #363636; padding:10px;">-</td>
        <td style="background: #363636; padding:10px;">Выбрать</td>
    </thead>
<?php
    //require 'settings.php';
    (string)$ph = $_GET['search'];
    if($ph == '' || $ph == null){
        $ph == null;
    }
    //printf($ph[1]);
    $result = mysqli_query(DBCon, "SELECT * FROM `product` WHERE `post_title` REGEXP '".$ph."' OR `article` REGEXP '".$ph."' ORDER BY `product`.`ID` ASC LIMIT 5;");
    if($result->num_rows != 0){
        while($row = $result->fetch_assoc()){
            printf("<tr style='background: #fff; color: black'>
            <td style='min-width: 100px; padding:10px;'>%s</td>
            <td style='min-width: 100px; padding:10px;'>%s</td>
            <td style='min-width: 100px; padding:10px;'>%s</td>
            <td style='min-width: 400px; padding:10px;'>-</td>
            <td style='padding:10px;' onclick=\"selectProduct('%s', '%s', '%s')\">Выбрать</td>
            </tr>",
            htmlspecialchars($row['ID']),
            htmlspecialchars($row['post_title']),
            (htmlspecialchars($row['Qty'])/1000),
            htmlspecialchars($row['ID']),
            htmlspecialchars($row['article']),
            htmlspecialchars($row['post_title'])
        );
        }
    } else {
        printf("<tr style='background: rgb(0,124,186); color:#fff; text-align:center;'>
            <td colspan=5 style='padding:10px;' onclick='createClient();document.getElementById(\"selectProduct\").remove();'>Нет результатов!</td>
            </tr>");

    }
        printf("</table></div>");
    //printf($_GET['phone']);


*/
    ?>