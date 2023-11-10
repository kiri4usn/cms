<?php

    class fatStock implements cont_plg_info{
        public function name(){
            return 'fatStock';
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
