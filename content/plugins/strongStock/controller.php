<?php
require_once '../../../settings.php';
require_once '../../functions/forms.php';
require_once '../../functions/docs.php';


if(isset($_GET['f'])){
    if ($_GET['f'] == 'productSearch' && $_GET['data'] != ''){
        try {

            $requst = mysqli_query(DBCon, "SELECT * FROM `product` WHERE `post_title` REGEXP '".$_GET['data']."' AND `post_type` LIKE 'productP' LIMIT 3;");
            while ($row = $requst->fetch_assoc()) {
                printf("<option value='".$row['post_title']."'></option>");
            }
        } catch (Exception $e){
            printf("");
        }
    }
    if($_GET['f'] == 'stockUpdate'){
        $requst = mysqli_query(DBCon, "SELECT * FROM `product` WHERE `ID` = ".$_GET['id']);
        $row = $requst->fetch_assoc();
        $requst = mysqli_query(DBCon, "SELECT * FROM `users` WHERE `ID` = ".$row['author_id']);
        $row2 = $requst->fetch_assoc();
        $form = new forms;

        $form->name_label("Уделка");
        $form->info_label('Менять сие значение может только администратор');
        $form->info_label($row['job']." %%");

        printf('<br>');

        $form->name_label("Добавил");
        $form->info_label($row2['user_nicename']);

        printf('<br>');

        $form->name_label("Средний расход / неделя");
        $form->info_label('unknown');

        printf('<br>');

        $form->name_label("Используеимость");
        $form->info_label('unknown');
    }
}

if(isset($_GET['addSKU'])) {
    try {
        if($_GET['nameSP'] != '' || $_GET['vendor'] != '' || $_GET['article'] != '' || $_GET['price'] != '' || $_GET['qty'] != '') {
            $name = $_GET['nameSP'];
            $vendor = $_GET['vendor'];
            $article = $_GET['article'];
            $price = $_GET['price'];
            $price = $price == '' ? 0 : $price;
            $qty = $_GET['qty'];
            $qty = $qty == '' ? 0 : $qty;
            mysqli_query(DBCon, "INSERT INTO `product` (`ID`, `price`, `post_title`, `post_parent`, `Description`, `vendor`, `post_type`, `visible`, `Qty`, `job`, `author_id`, `firePosition`) VALUES (NULL, '" . $price . "', '" . $name . "', '1', '{}', '" . $vendor . "', 'productP', '0', '0', '0', '1', '0');");
            printf("OK");
        } else {
            printf("Err: Введены не все данные");
        }
    } catch (Exception $e){
        printf("Err: ".$e);
    }
}

if(isset($_GET['editSKU'])) {
    try {
        if($_GET['nameSP'] != ''){
            mysqli_query(DBCon, "UPDATE `product` SET `post_title` = '".$_GET['nameSP']."' WHERE `product`.`ID` = ".$_GET['id']);
        }
        if($_GET['vendor'] != ''){
            mysqli_query(DBCon, "UPDATE `product` SET `vendor` = '".$_GET['vendor']."' WHERE `product`.`ID` = ".$_GET['id']);
        }
        if($_GET['article'] != ''){
            mysqli_query(DBCon, "UPDATE `product` SET `article` = '".$_GET['article']."' WHERE `product`.`ID` = ".$_GET['id']);
        }
        if($_GET['price'] != ''){
            $price = $_GET['price'];
            $price = $price == '' ? 0 : $price;
            mysqli_query(DBCon, "UPDATE `product` SET `price` = '".$price."' WHERE `product`.`ID` = ".$_GET['id']);
        }
        if($_GET['qty'] != ''){
            $qty = $_GET['qty'];
            $qty = $qty == '' ? 0 : $qty;
            mysqli_query(DBCon, "UPDATE `product` SET `Qty` = '".$qty."' WHERE `product`.`ID` = ".$_GET['id']);
        }
        printf("OK");
    } catch (Exception $e){
        printf("Err: ".$e);
    }
}

if(isset($_GET['consumption'])){
    try {
        $requst = mysqli_query(DBCon, "SELECT * FROM `product` WHERE `post_title` LIKE '" . $_GET['nameSP'] . "'");
        $row = $requst->fetch_assoc();
        $qty = $row['Qty'] - $_GET['qty'];
        mysqli_query(DBCon, "UPDATE `product` SET `Qty` = ".$qty." WHERE `product`.`post_title` LIKE '" . $_GET['nameSP'] . "'");
        $user = mysqli_query(DBCon, "SELECT * FROM `users` WHERE `user_activation_key` LIKE '".$_COOKIE['token']."'");
        $user = $user->fetch_assoc();
        $docs = new docs;

        $arr = array();
        $arr['name'] = $row['post_title'];
        $arr['qty'] = $_GET['qty'];
        $arr['author_id'] = $user['ID'];
        $arr['base'] = $_GET['base'];

        $json = json_encode($arr, JSON_UNESCAPED_UNICODE);
        $docs->new_doc('consumption', 'doc', $json);

        printf("OK");
    } catch (Exception $e){
        printf("Err: ".$e);
    }

}

if(isset($_GET['comingD'])){
    try {
        $docs = new docs;
        $json = json_decode($_GET['json']);
        $n = array("invoice" => $_GET['invoice   5'], "lines" => $_GET['json']);
        $n = json_encode($n);
        $docs->new_doc('coming', 'doc', $n);

        $json = json_decode($_GET['json']);

        $i = 0;

        foreach($json as $key => $qty){
            $result = mysqli_query(DBCon, "SELECT * FROM `product` WHERE `ID` = ".$key);
            $row = $result->fetch_assoc();
            $qty = $row['Qty'] + $qty * 1000;
            mysqli_query(DBCon, "UPDATE `product` SET `Qty` = '".$qty."' WHERE `product`.`ID` = ".$key.";");
        }

        printf("OK");
    } catch (Exception $e){
        printf("Err: ".$e);
    }

}


