<?php

class docs{
    public function public_interface(){
    }

    public function new_doc($name, $type, $description){
        mysqli_query(DBCon, "INSERT INTO `docs` (`id`, `post_name`, `post_type`, `Description`) VALUES (NULL, '".$name."', '".$type."', '".$description."');");
    }
}