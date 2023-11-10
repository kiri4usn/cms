<?php
const BS260_Length = 48;
class BS260_pattern{
    public function orderLine($printhost, $str){
        $lineLength = (BS260_Length - strlen($str))/2;
        $line = '';
        for($i = 0; $i < $lineLength; $i++){
            $line .= '-';
        }
        $line .= $str;
        for($i = 0; $i < $lineLength; $i++){
            $line .= '-';
        }
        $line = 'http://'.$printhost.'/prt_test.htm?content='. $line;
        return $line;
    }
    public function cutPaper(){
        $cut_paper = "&Cutter=Cutter+Paper";
        return $cut_paper;
    }
    public function send(){
        $send = "&Send=Print+Test";
        return $send;
    }
    public function nextLine($printhost){
        $nextLine = 'http://'.$printhost.'/prt_test.htm?content=0A&hex_mode=checked';
        return $nextLine;
    }
    public function priceLine($printhost){
        $priceLine= 'http://'.$printhost.'/prt_test.htm?content=09&hex_mode=checked';
        return $priceLine;
    }
    public function blackBackground($printhost){
        $black_background = 'http://'.$printhost.'/prt_test.htm?content=1D+42+01&hex_mode=checked';
    }
}

/******** Font ********//*
$big_size = 'http://'.$printhost.'/prt_test.htm?content=1B+21+10+1B+45+01&hex_mode=checked';
$black_background = 'http://'.$printhost.'/prt_test.htm?content=1D+42+01&hex_mode=checked';
$space = 'http://'.$printhost.'/prt_test.htm?content=20&hex_mode=checked';
$standart_font = 'http://'.$printhost.'/prt_test.htm?content=1B+21+00+1B+45+00+1D+42+00&hex_mode=checked';
$start_barcode = 'http://'.$printhost.'/prt_test.htm?content=1С+x28+x6b&hex_mode=checked';

*/