<?php
require '../settings.php';
$plg = $_GET['plg'];

require 'plugins/'.$plg.'/install.php';

$plg = new $plg;
$plg->plgOff(DBCon);

header("Location: localhost:8080");