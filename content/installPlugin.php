<?php
require '../settings.php';
$plg = $_GET['plg'];

require 'plugins/'.$plg.'/install.php';

$plg = new $plg;
$plg->install_query(DBCon);
