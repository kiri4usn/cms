<?php

class metro {
    public function public_interface(){
        printf("");
    }

    public function metro_p($name, $value, $value2 = '', $onclick = ''){
        $onclick = $onclick==''?'':"onclick='".$onclick."'";
        printf("<div ".$onclick." style='display: inline-block; margin: 10px; box-shadow: #f1f0f0 0 0 5px 3px;border: 1px #ababab solid;width: 300px; padding:20px; border-radius: 10px;'><h3>" .$name."</h3><h5>".$value."</h5><h5>".$value2."</h5></div>");
    }
}
