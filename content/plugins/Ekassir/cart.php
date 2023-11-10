<?php
require_once '../../../settings.php';
try{
    $result = mysqli_query(DBCon, "SELECT * FROM `users` WHERE `user_activation_key` LIKE '" . $_COOKIE['token'] . "'");
    $row = $result->fetch_assoc();
    $cart = json_decode($row['cart']);
    (array)$cart = (array)$cart->Lines;

    require_once '../../functions/tables.php';

    $tables = new tables;

    $tables->createTable('', 'thisTable');

    $tables->createThead('');
    $tables->openTheadTr();
    $tables->createTd('Название');
    $tables->createTd('+', 'width: 20px; text-align: center;');
    $tables->createTd('Колл', 'width: 40px; text-align: center;');
    $tables->createTd('-', 'width: 20px; text-align: center;');
    $tables->createTd('Сумма', 'width: 100px; text-align: center');
    $tables->closeThead();


    $summ = 0;
    for($i = 0; $i < count($cart); $i++){
        $tables->openTr();
        $tables->createTd($cart[$i]->Description);
        $tables->createTd('<p style="width: 30px; height: 30px; background: #d2d1d1; border-radius: 5px" onclick="loadPId(' .$cart[$i]->ServiceDescription.')">+</p>', 'text-align: center;');
        $tables->createTd($cart[$i]->Qty/1000, 'text-align: center;', 'Pid="'.$cart[$i]->ServiceDescription.'"');
        $tables->createTd('<p style="width: 30px; height: 30px; background: #d2d1d1; border-radius: 5px" onclick="remPId(' .$cart[$i]->ServiceDescription.')">-</p>', 'text-align: center;');
        $tables->createTd($cart[$i]->Qty/1000*$cart[$i]->Price/100, 'text-align: center;');
        $tables->closeTr();
        $summ += $cart[$i]->Qty/1000*$cart[$i]->Price/100;
    }
    //$tables->closeTable();
} catch (JsonExcepton $e){

}
//$tables->openTr();
//printf("<td style='text-align: center; background: rgb(0,124,186); color: #fff; font-weight: 600; font-size: 24px; border-radius: 0 0 10px 10px' colspan='5' onclick='location.replace(\"\")'>Далее ".$summ."</td>");
//printf("<div style='border-radius: 0 0 10px 10px;height: 90px;width: 100px;background: #2271b1;'></div>");