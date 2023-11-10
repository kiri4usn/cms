<?php

require_once 'escpos-php-master/autoload.php';
require_once '../../../settings.php';


$id = $_GET['id'];
$order = mysqli_query(DBCon, "SELECT * FROM `orders` WHERE `ID` = ".$id);

$check = $order->fetch_assoc();
$check = json_decode($check['Ocheck']);


use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use Mike42\Escpos\Printer;
$connector = new NetworkPrintConnector("192.168.28.209", 9100);
$printer = new Printer($connector);
try {
	//$printer->setDoubleStrike(true);
    $printer->setFont(Printer::FONT_B);
	$printer->setTextSize(2,2);
    $printer->text("            БЛА ЕДА\n\n");
    $printer->setFont(Printer::FONT_A);
    $printer->setTextSize(1,1);
    $printer->text("                 КАССОВЫЙ ЧЕК\n\n");

    $printer->text("  Цена до сккидки   Цена     Кол-во       Итого\n");
    for($i = 0; $i < count($check->Lines); $i++){
    	$printer->text($check->Lines[$i]->Description."\n");
    	//$printer->text("  Цена до сккидки   Цена     Кол-во      Итого\n");
    	$line = sprintf('%s %6.2F %11.2F %8.0F %11.2F',
    		"Без НДС", $check->Lines[$i]->Price/100,
    		$check->Lines[$i]->Price/100,
    		$check->Lines[$i]->Qty/1000,
    		$check->Lines[$i]->Qty/1000*$check->Lines[$i]->Price/100);
    	$printer->text($line."\n");
        $printer->setFont(Printer::FONT_B);
        $printer->text("\n");
        $printer->setFont(Printer::FONT_A);
    }
  	$printer->text("------------------------------------------------\n");
    $printer->setFont(Printer::FONT_B);
  	$printer->text("ИП \"Киселев Артур Анреевич\"\n");
  	$printer->text("ИНН : 1234567890 СНО : УСН\n");
    $printer->text("ЗН ККТ : 00000003850097495975\n");
    $printer->text("РН ККТ : 00000003850097495975\n");
    $printer->text("ФН : 1234567890123456\n");
    $printer->text("ПРИХОД ".date('d.m.y H:i', (time()+(60*60*2)))."\n");
    $printer->text("Сайт ФНС www.nalog.gov.ru\n\n");
    $printer->qrCode('t=20181007T2151&s=1955.49&fn=8710000101838052&i=18487&fp=2392195712&n=1', Printer::QR_ECLEVEL_L, 4);

    $printer->cut();
} finally {
    $printer -> close();
}
?>