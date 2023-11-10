<?php
const DBHost = 'localhost';
const DBUsr = 'root';
const DBPsswd = '511024Pk';
const DBName = 'bla_eda';
define("DBCon", mysqli_connect(DBHost, DBUsr, DBPsswd, DBName));

define("TimeZone", 60*60*5);

const Sname = 'БЛА ЕДА';

const Ver = '0.0.1 beta on KSLV framework';

interface plg_install{
    public function install_query($con);
    public function PLgOff($con);
    public function PLgOn($con);
}

interface cont_plg_info {
    public function name();
    public function version();
}