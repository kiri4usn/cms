
<?php

class menu{
    public function public_interface(){
        $privilege = mysqli_query(DBCon, "SELECT * FROM `users` WHERE `user_activation_key` LIKE '".$_COOKIE['token']."'");
        $privilege = $privilege->fetch_assoc();
        $privilege = $privilege['privilege'];
        printf("<div id='adminmenuback'>");
        $result = mysqli_query(DBCon, "SELECT * FROM `pages` WHERE `privilege` <= ".$privilege." ORDER BY `pages`.`Porder` ASC");
        $i = 0;
        while($row = $result->fetch_assoc()) {
            if($row['name'] == 'Касса'){
                printf("<p class='mp' onclick='loadpage(\"%s\"); editclass(".$i."); cartUpdate();'>%s</p><br>",
                htmlspecialchars($row['path']),
                htmlspecialchars($row['name']));
            } else {
                printf("<p class='mp' onclick='loadpage(\"%s\"); editclass(".$i.")'>%s</p><br>",
                htmlspecialchars($row['path']),
                htmlspecialchars($row['name']));
            }
            $i++;
        }
        printf("</div>");

    }
}

