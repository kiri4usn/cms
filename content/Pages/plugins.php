<?php



require_once '../funcloader.php';
require_once '../../settings.php';
require_once '../logger.php';

func_loader();

$checkUpdates = new updater;

$page = new page;
$pb = '';
$pb .= $page->addPageButton('Магазин приложений', 'content/plugins/index.php');

$page->alert(0, "<p>Ничего не трогать!!!!</p>");
$page->pagename('Плагины', $pb);


function plg_loader(){
    $table = new tables;
    $table->createTable('thisTable','');
    $table->createThead('');
    $table->openTheadTr();
    $table->createTd('Название плагина');
    $table->createTd('Путь');
    $table->createTd('Версия');
    $table->createTd('Тип плагина');
    $table->createTd('Статус');
    $table->closeThead();

    $list = scandir('../../content/plugins');
    unset($list[0]);
    unset($list[1]);
    foreach($list as $plg_name){
        if(is_file('../plugins/'.$plg_name.'/plg-info.php')) {
            $checkUpdates = new updater;
            require_once '../plugins/' . $plg_name . '/plg-info.php';
            $plg = $plg_name;

            $plg_info = new $plg;
            if ($plg_info->visible()) {
                $updates = $checkUpdates->checkPluginUpdates($plg_name, $plg_info->version()) ? "" : 'ㅤㅤ(Доступно обновление)<br><p  class="noshow bluecol d" onclick="loadpage(' . '\'/content/update.php?plg=' . $plg_name . '\')">Обновить</p>';

                $result = mysqli_query(DBCon, "SELECT * FROM `plugins` WHERE `name` LIKE '" . $plg_info->name() . "'");
                if ($result) {
                    $row = $result->fetch_assoc();
                    if ($row) {
                        $enable = $row['enable'] ? 'Работает <a class="AbuttonRed" onclick="loadpage(location.origin+location.pathname+' . '\'/content/plgOff.php?plg=' . $plg_name . '\')">Отключить</a>' : 'Выключен <a class="AbuttonBlue" onclick="loadpage(location.origin+location.pathname+' . '\'/content/plgOn.php?plg=' . $plg_name . '\')">Включить</a>';
                        $enable = $row['install'] ? $enable : 'Не установлен <a class="AbuttonBlue" onclick="loadpage(location.origin+location.pathname+' . '\'/content/installPlugin.php?plg=' . $plg_name . '\')">Установить</a>';
                    } else $enable = 'Не установлен <a class="AbuttonBlue" onclick="loadpage(location.origin+location.pathname+' . '\'/content/installPlugin.php?plg=' . $plg_name . '\')">Установить</a>';
                }
                $table->openTr();
                $table->createTd($plg_info->name() . '<br>' .
                    '<p class="noshow bluecol" onclick="loadpage(\'content/plugins/' . $plg_name . '/settings.php\')">Настроить</p>' .
                    '<p class="noshow greycol">|</p>' .
                    '<p class="noshow redcol" onclick="loadpage(\'content/plugins/' . $plg_name . '/uninstall.php\')">Удалить</p>');
                $table->createTd('../content/plugins/' . $plg_name);
                $table->createTd($plg_info->version() . $updates);
                $table->createTd($plg_info->plg_type());
                $table->createTd($enable);
                $table->closeTr();
            }
        }
        $enable = '';
    }
}

plg_loader();