<?php


class Ekassir implements plg_install {
    public function install_query($con){
        mysqli_query($con, "INSERT INTO `plugins` (`id`, `install`, `path`, `name`, `enable`, `scriptPath`) VALUES (NULL, '1', '../content/plugins/Ekassir/', 'e-kassir', '1', '');");
        mysqli_query($con, "INSERT INTO `plugins` (`id`, `install`, `path`, `name`, `enable`, `scriptPath`) VALUES (NULL, '1', '../content/plugins/Ekassir/', 'e-kassir', '1', '');");
    }
}