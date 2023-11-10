<?php

require 'settings.php';

$result = mysqli_query(DBCon, "SELECT * FROM `users` WHERE `user_pass` LIKE '".md5($_GET['psswd'])."'");
$row = $result->fetch_assoc();
if($row == null){
    header("Location: login.php");
} else {
    $token = md5(time().md5($_GET['psswd']));
    $result = mysqli_query(DBCon, "UPDATE `users` SET `user_activation_key` = '".$token."' WHERE `user_pass` LIKE '".md5($_GET['psswd'])."'");
    setcookie('token', $token);
    setcookie('usr', $row['user_nicename']);
    header("Location: index.php");
}