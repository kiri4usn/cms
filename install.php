<?php

require 'content/functions/forms.php';
require 'content/functions/page.php';


    function send_ajax($content){
    printf('<style>
            *{
                padding:0;
                margin:0;
                font-family: "Apple SD Gothic Neo";
            }

            body {
                background: #f0f0f1;
            }
            .pagename {
                background: #fff;;
                padding: 20px 20px 20px 60px;
                font-weight: 600;
                margin-bottom:30px
            }
            .button{
                border: 1px solid rgb(0,124,186);
                background: #fff;
                border-radius: 5px;
                color:#5d5d5d;
                padding: 3px;
                width: fit-content;
            }
            #erralert {
                background: rgb(255, 34, 82) !important;
                color: #fff;
                padding: 20px 20px 20px 20px;
                font-weight: 600;
                text-align: center;
                width: 100%%;
                z-index: 1000;
                position: fixed;
                top: 0;
                left:0;
            }
            #thisform {
                background: #fff;
                width: 400px;
                display: inline-block;
                margin-left:calc(100%% / 2 - 220px);
                padding: 20px;
                border-radius: 10px;
            }

            label {
                font-weight: 600;
            }

            .infolabel {
                font-weight: 100;
                font-size: 14px;
            }

            input{
                margin-bottom: 15px;
            }

    </style>');
    printf("<div id='content'>");
    printf('<script>
    function delalert(){setTimeout(() => {console.log(1);document.getElementById("erralert").remove();}, 5000);} delalert();
    function send(s){
        var url = 
        "?fnc=tst&host="+document.getElementsByName("addr")[0].value+
        "&usr="+document.getElementsByName("usr")[0].value+
        "&psswd="+document.getElementsByName("psswd")[0].value+
        "&pref="+document.getElementsByName("pref")[0].value+
        "&sname="+document.getElementsByName("sname")[0].value;
        
        var xhr = new XMLHttpRequest();
        xhr.open("GET",url,false);
        xhr.send();
        if(xhr.responseText == "ok"){
            location.replace("?fnc=2");
        } else {
            document.getElementById("content").insertAdjacentHTML("beforeEnd", xhr.responseText);
        }

    }
    </script>');
    printf("<p class='button' onclick='send(); delalert();'>".$content."</p>");
}


if(!isset($_GET['fnc'])){
    $page = new page;
    $page->pagename('blue', 'Установка');



    $form = new forms;
    $form->openform('post', 'install.php', 'thisform');
    printf("<h1>Шаг 1</h1><h3>Настройка базы данных</h3><br><br>");
    $form->name_label('Адрес базы данных');
    $form->info_label('Обычно это localhost');
    $form->input('addr', '', '');

    $form->name_label('Пользователь');
    $form->info_label('Имя пользователя базы данных. Пожалуйста, не используйте root, если используете открытый хостинг.');
    $form->input('usr', '', '');

    $form->name_label('Пароль');
    $form->info_label('Пароль пользователя базы данных. Обязательное поле.');
    $form->input('psswd', '', '');

    $form->name_label('Название Базы данных(на английском)');
    $form->info_label('Можно оставить пустым.');
    $form->input('pref', '', '');

    $form->name_label('Имя магазина');
    $form->info_label('Можно оставить пустым.');
    $form->input('sname', '', '');

    send_ajax('Отпавить');
    $form->closeform();
} else {
    if($_GET['fnc'] == 'tst'){
        try{
            $DB = new mysqli($_GET['host'], $_GET['usr'], $_GET['psswd']);
            $file = "<?php\n";
            $file .= "const DBHost = '".$_GET['host']."';\n";
            $file .= "const DBUsr = '".$_GET['usr']."';\n";
            $file .= "const DBPsswd = '".$_GET['psswd']."';\n";
            $file .= "const DBName = '".$_GET['pref']."';\n";
            $file .= "define(\"DBCon\", mysqli_connect(DBHost, DBUsr, DBPsswd, DBName));\n\n\n";
            $file .= "const Sname = '".$_GET['sname']."';\n";
            file_put_contents('settings.php', $file);
            $DBcon = mysqli_connect($_GET['host'], $_GET['usr'], $_GET['psswd']);
            try{mysqli_query($DBcon,"CREATE DATABASE ".$_GET['pref']);}catch (Exception $e){};
            $DBcon = mysqli_connect($_GET['host'], $_GET['usr'], $_GET['psswd'], $_GET['pref']);
            mysqli_query($DBcon,"
                CREATE TABLE `users` (
                  `ID` bigint UNSIGNED NOT NULL,
                  `user_login` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
                  `user_pass` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
                  `user_nicename` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
                  `user_email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
                  `user_url` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
                  `user_activation_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
                  `user_status` int NOT NULL DEFAULT '0',
                  `display_name` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
                  `cart` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;");
            mysqli_query($DBcon,"
                INSERT INTO `users` (`ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_activation_key`, `user_status`, `display_name`, `cart`) VALUES
                (1, 'adm', '25d55ad283aa400af464c76d713c07ad', 'adm', '', '', 'a0a45ec8d9a43ca6caf73d10d0ab84f4', 0, 'adm', NULL);");
            mysqli_query($DBcon,"
                ALTER TABLE `users`
                  ADD PRIMARY KEY (`ID`),
                  ADD KEY `user_login_key` (`user_login`),
                  ADD KEY `user_nicename` (`user_nicename`),
                  ADD KEY `user_email` (`user_email`);");
            mysqli_query($DBcon,"CREATE TABLE `bla_eda`.`pages` (`id` INT NOT NULL AUTO_INCREMENT , `name` TEXT NOT NULL , `path` TEXT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;");
            mysqli_query($DBcon,"INSERT INTO `pages` (`id`, `name`, `path`) VALUES (NULL, 'Дашборд', 'content/Pages/dashboard.php');");
            mysqli_query($DBcon,"INSERT INTO `pages` (`id`, `name`, `path`) VALUES (NULL, 'Настройки', 'content/Pages/settings.php');");
            mysqli_query($DBcon, "CREATE TABLE `bla_eda`.`settings` (`Id` INT NOT NULL AUTO_INCREMENT , `name` TEXT NOT NULL , `patch` TEXT NOT NULL , `nace_name` TEXT NOT NULL , PRIMARY KEY (`Id`)) ENGINE = InnoDB;");
            mysqli_query($DBcon, "INSERT INTO `settings` (`Id`, `name`, `patch`, `nace_name`) VALUES (NULL, 'basic', 'content/pages/settings/basic.php', 'Базовые');");

            header("Location: index.php");
            printf("ok");
        }catch (Exception $e){
            printf("
            <div id='erralert'>Подключение к базе данных не удалось!".$e->getMessage()."</div>
            ");

        }
    }
}