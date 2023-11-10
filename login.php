<?php ?>

<link rel="stylesheet" type="text/css" href="login.css">


    <div id="content">
        <form id="loginform" method="get" action="login_check.php">
            <label for="user_login">Имя пользователя или личный код</label><br>
            <input name='pin'></input>
            <input name='pin'></input>
            <input name='pin'></input>
            <input name='pin'></input>
            <input name='pin'></input>
            <input name='pin'></input>
            <input name='pin'></input>
            <input name='pin'></input>
        </form>
    </div>

    <script>
        document.getElementsByName('pin')[0].focus();
        function pin(){
            for(var i = 0; i < 7; i++){
                if(document.getElementsByName('pin')[i].value != ''){
                    document.getElementsByName('pin')[i+1].focus();
                }
            }
            setTimeout(() => {pin();}, 100);
            if(document.getElementsByName('pin')[7].value != ''){
                var s = '';
                for(var i = 0; i < 8; i++){
                        s += document.getElementsByName('pin')[i].value;
                }
                location.replace("login_check.php?psswd="+s);
            }
            
        }
            pin();
    </script>

