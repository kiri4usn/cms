<?php

class modalprofile
{
    public function public_interface()
    {
        printf("");
    }
}
if(isset($_GET['str'])) {
    printf('
<style>
    #modalUsr {
        width: 200px;
        background: linear-gradient(56deg, rgb(68,49,121) 0%%, rgba(80,57,142,1) 100%%);
        backdrop-filter: blur(5px);
        z-index: 10000;
        right: 0;
        top: 45px;
        position: fixed;
    }
    #modalUsr .usr{
        width: 200px;
        text-align: center;
        color: #f0f0f1;
        font-size: 24px;
        padding-top: 10px;
        padding-bottom: 10px;
        font-weight: 200;
    }
    #modalUsr .token{
        width: 180px;
        text-align: left;
        font-size: 10px;
        color: #f0f0f1;
        padding-top: 10px;
        padding-bottom: 10px;
        font-weight: 200;
        word-wrap: break-word;
        padding: 10px;
    }
    #modalUsr .bt{
        display: inline-block;
        font-size: 15px;
        width: 95px;
        text-align: center;
        color: #fff;
        font-weight: 200;
        padding-bottom: 10px;
    }
</style>
<div id="modalUsr">
    <p class="usr">%s</p>
    <p class="token">token: %s</p>
    <p class="bt" onclick="CookiesDelete()">Выход</p>
    <p class="bt">Профиль</p>
</div>', $_COOKIE['usr'], $_COOKIE['token']);
}