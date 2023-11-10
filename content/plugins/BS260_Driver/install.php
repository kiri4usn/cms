<?php

class BS260_Driver implements plg_install {
    public function install_query($con){
        mysqli_query(DBCon, "INSERT INTO `plugins` (`id`, `install`, `patch`, `name`, `enable`) VALUES (NULL, '0', '../content/plugins/BS260_Driver/', 'B-Smart BS260 web Driver', '0');");
    }
    public function PLgOff($con){
        mysqli_query(DBCon, "UPDATE `plugins` SET `enable` = '0' WHERE `plugins`.`name` = 'B-Smart BS260 web Driver';");
        mysqli_query(DBCon, "DELETE FROM `pages` WHERE `pages`.`name` = 'BS260'");
    }
    public function PLgOn($con){
        mysqli_query(DBCon, "UPDATE `plugins` SET `enable` = '1' WHERE `plugins`.`name` = 'B-Smart BS260 web Driver';");
        mysqli_query(DBCon, "INSERT INTO `pages` (`id`, `name`, `path`, `Porder`) VALUES (NULL, 'BS260', 'content/plugins/BS260_Driver/page.php', '5');");
    }
}