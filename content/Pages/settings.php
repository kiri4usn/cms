<?php
    require_once '../funcloader.php';
    require_once '../../settings.php';
    require_once '../logger.php';

    //$title = new title;
    //$title->setTitle('dsf');

    func_loader();
    $page = new page;
    $pb = '';

    $result = mysqli_query(DBCon ,"SELECT * FROM `settings`");
    while ($row = $result->fetch_assoc()){
        $pb .= $page->addPageButton($row['nice_name'], $row['path']);
    }
    $page->alert(0, "Меняйте и настраивайте только в случае есть <p>знаете что делаете!</p>");
    //$page->alert(1,"🎉 Если есть товар, то продавай! А то для чего он еще <p>нужен</p>?");
    $page->pagename('Настройки', $pb);


