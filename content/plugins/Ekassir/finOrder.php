<?php
require_once '../../../settings.php';
require_once '../../functions/forms.php';
require_once '../../functions/page.php';

$page = new page;
$page->alert(1, "Финаль");
$pb = $page->addPageButton('К заказу','content/plugins/Ekassir/page.php', 'cartUpdate();');
$page->pagename('Завершение заказа', $pb);
?>

