<?php

require_once '../../../settings.php';

if(isset($_GET['clearCart'])){
    $result = mysqli_query(DBCon, "UPDATE `users` SET `cart` = '{\"Lines\":[]}' WHERE `users`.`user_activation_key` = '".$_COOKIE['token']."';");
}