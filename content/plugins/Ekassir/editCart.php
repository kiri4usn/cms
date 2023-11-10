<?php

require '../../../settings.php';
$result = mysqli_query(DBCon, "SELECT * FROM `users` WHERE `user_activation_key` LIKE '" . $_COOKIE['token'] . "'");
$row1 = $result->fetch_assoc();
$cart = json_decode($row1['cart']);
$err = '';
$id = $_GET['id'];
$result2 = mysqli_query(DBCon, "SELECT * FROM `product` WHERE `ID` = " . $id);
$row = $result2->fetch_assoc();
$parent_id = $row['post_parent'];
var_dump($row1['cart']);

if($_GET['fnc'] == 'plus') {
    if ($row1['cart'] == '' || $row1['cart'] == 'null' || $row1['cart'] == NULL) {

        $cartarray = array(
            "Lines" => ""
        );
        $line = array(
            "Qty" => 1000,
            "Description" => $row['post_title'],
            "Price" => $row['price'],
            "PayAttribute" => 4,
            "TaxId" => 1,
            "ServiceDescription" => $id,
        );


        $Line = array("Lines" => array());
        array_push($Line['Lines'], $line);
        //var_dump( $line);
        $line = json_encode($Line, JSON_UNESCAPED_UNICODE);
        $result = mysqli_query(DBCon, "UPDATE `users` SET `cart` = '" . $line . "' WHERE `users`.`user_activation_key` = '" . $_COOKIE['token'] . "'");
        //var_dump($result);
    } else {
        $scale = '';
        //printf($scale);
        for ($i = 0; $i < count($cart->Lines); $i++) {
            if ($cart->Lines[$i]->ServiceDescription == $row["ID"]) {
                $scale = $i;
            }
        }
        printf($scale);
        if ($scale != '') {
            $cart->Lines[$scale]->Qty += 1000;
        } else {
            $line = array(
                "Qty" => 1000,
                "Description" => $row['post_title'],
                "Price" => $row['price'],
                "PayAttribute" => 4,
                "TaxId" => 1,
                "ServiceDescription" => $id,
            );
            array_push($cart->Lines, $line);
            var_dump($line);
        }


        $line = json_encode($cart, JSON_UNESCAPED_UNICODE);
        mysqli_query(DBCon, "UPDATE `users` SET `cart` = '" . $line . "' WHERE `users`.`user_activation_key` = '" . $_COOKIE['token'] . "'");
    }
} else {
    if ($_GET['fnc'] == 'minus'){
        $scale = '';
        //printf($scale);
        for ($i = 0; $i < count($cart->Lines); $i++) {
            if ($cart->Lines[$i]->ServiceDescription == $row["ID"]) {
                $scale = $i;
            }
        }
        printf($scale);
        if ($scale != '') {
            $cart->Lines[$scale]->Qty -= 1000;
            if ($cart->Lines[$scale]->Qty == 0 || $cart->Lines[$scale]->Qty < 0){
                array_splice($cart->Lines, $scale, 1);
            }
        }

        $line = json_encode($cart, JSON_UNESCAPED_UNICODE);
        mysqli_query(DBCon, "UPDATE `users` SET `cart` = '" . $line . "' WHERE `users`.`user_activation_key` = '" . $_COOKIE['token'] . "'");
    }

}