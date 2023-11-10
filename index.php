<?php require_once 'settings.php'; ?>
<head>
    <link rel="stylesheet" type="text/css" href="main.css"/>
    <script async src="content/scripts/main.js"></script>
    <link href="content/fontawesome-free-6.4.2-web/css/fontawesome.css" rel="stylesheet"/>
    <link href="content/fontawesome-free-6.4.2-web/css/brands.css" rel="stylesheet"/>
    <link href="content/fontawesome-free-6.4.2-web/css/solid.css" rel="stylesheet"/>
    <script defer src="content/fontawesome-free-6.4.2-web/js/brands.js"></script>
    <script defer src="content/fontawesome-free-6.4.2-web/js/solid.js"></script>
    <script defer src="content/fontawesome-free-6.4.2-web/js/fontawesome.js"></script>

    <?php
    $plugins = mysqli_query(DBCon, "SELECT * FROM `plugins`");
    while ($row = $plugins->fetch_assoc()){
        //printf('<script src="'.$row['scriptPath'].'"></script>');
    }
    ?>
</head>
<?php

!file_exists('settings.php')?header('Location: install.php'):0;

$result = mysqli_query(DBCon , "SELECT * FROM `plugins` WHERE `enable` = 1");
while ($row = $result->fetch_assoc()){
    if (file_exists($row['path'])) {
        require $row['path'];
    }
    printf("<script async src='".$row['scriptPath']."'></script>");
}


function func_loader(){
    $list = scandir('content/functions/');
    foreach($list as $fnc_name){
        if(is_file('content/functions/'.$fnc_name)) {
            require_once 'content/functions/' . $fnc_name;

            $fnc_name = mb_substr($fnc_name, 0 ,-4);
            $fnc = $fnc_name;
            $plg_info = new $fnc;
            $plg_info->public_interface();
            //var_dump($plg_info->public_interface());
        }
    }
}

if(!empty($_COOKIE['token']) && !empty($_COOKIE['usr'])) {
    func_loader();
} else {
    header("Location: login.php");
}
?>
</head>
<script>setInterval(() => ajax(), 2000);</script>
<div id='content'></div>

<div id='toolbar'>


    <i onclick='fs();' class='fa-solid fa-expand'></i>
    <a href='runapp:osk'><i class='fa-regular fa-keyboard'></i></a>

</div>

<!--<script>loadpage("content/Pages/dashboard.php");</script>-->