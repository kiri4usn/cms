<?php

require_once 'tables.php';

class search{
    public function public_interface(){
    }
    public function createSearchForm($DBtable, $str = ''){
        $table = new tables;
        $table->createTable('thisTablse', '','height: 40px !important');
        $table->openTr();
        $table->createTd('<input id="searchinTable" placeholder="'.$str.'" style="width: 100%%; height: 60px; font-size: 24px; text-align: center"></input>');
        //$table->createTd('Поиск <i class="fa-solid fa-magnifying-glass"></i>');
        $table->closeTr();
        $table->closeTable();
    }
}