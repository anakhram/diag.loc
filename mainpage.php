<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <?php
        
        $host = 'localhost';
        $user = 'root';
        $pass = '';
        $db_name = 'registr-bd';
        $id = $_COOKIE['id'];       
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $link = mysqli_connect($host, $user, $pass, $db_name);

        if (!$link) {
            echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
            exit();
        } 
        else {

            $sql = mysqli_query($link, "SELECT `id`, `name`, `surname`, `patr`, `gend`, `dateb`, `placeReg`, 
            `telNum`, `terr`, `polis`, `SNILS`, `nameStrOrg`, `numPriv`, `typeDoc`, `numDoc` FROM `users`
            WHERE `id` LIKE '$id'");
            while($result = mysqli_fetch_assoc($sql)){
                printf ("%s (%s)\n" ,$result["name"], $result["surname"]);
        }
            $res = mysqli_fetch_all($sql);
            if ($sql === false) {
                echo mysql_error();
            }
            echo $res[`name`];
        }
        ?>
    </body>
</html>
    