<?php

require_once '../../../settings.php';
require_once 'fnc.php';

$kassir = new kassir;
$id = $_GET['id'];
if($id!='0') {


    $result = mysqli_query(DBCon, "SELECT * FROM `product` WHERE `ID` = " . $id . " LIMIT 1;");
    $row = $result->fetch_assoc();

//var_dump($row);
    $kassir->createCategory("Назад", $row['post_parent']);
}
$result = mysqli_query(DBCon, "SELECT * FROM `product` WHERE `post_parent` = ".$id." AND `post_type` LIKE 'catalog' AND `visible` != 0");

//$kassir->createCategory('Назад', $id);
while ($row = $result->fetch_assoc()){
    //$kassir->createCategory('Назад', $row['ID']);
    $kassir->createCategory($row['post_title'], $row['ID'], $row['style']);
}

$result = mysqli_query(DBCon, "SELECT * FROM `product` WHERE `post_parent` = ".$id." AND `post_type` LIKE 'productF' AND `visible` != 0");

//$kassir->createCategory('Назад', $id);
while ($row = $result->fetch_assoc()){
    $kassir->createProduct($row['post_title'], $row['ID'], ($row['price']/100).' Руб.', $row['Qty']/1000);
}