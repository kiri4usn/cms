<?php

    class strongStock implements cont_plg_info{
        public function name(){
            return 'strongStock';
        }
        public function version(){
            return '0.0.1';
        }
        public function plg_type(){
            return 'Functional';
        }
        public function visible(){
            return 0;
        }
    }
