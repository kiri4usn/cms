<?php

class kassir{
    public function createCategory($name, $id, $style = ''){
        printf('<div class=category style="'.$style.'" onclick="loadCId('.$id.')"><p class="content">'.$name.'</p></div>');
    }
    public function createProduct($name, $id, $price = 0, $qty = 0){
        printf('<div qty="'.$qty.'" class="product" onclick="loadPId('.$id.','.$qty.')"><p class="content">'.$name.'<br>'.$price.'<br>'.$qty.' ШТ.</p></div>');
    }
}