<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta lang="ru">
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
    } else {

        $sql = mysqli_query($link, "SELECT `id`, `name`, `surname`, `patr`, `gend`, `dateb`, `placeReg`, 
            `telNum`, `terr`, `polis`, `SNILS`, `nameStrOrg`, `numPriv`, `typeDoc`, `numDoc` FROM `users`
            WHERE `id` LIKE '$id'");
        while ($result = mysqli_fetch_assoc($sql)) { ?>

            <h1> Добро пожаловать, <?php echo $result["name"] . " " . $result["patr"] ?></h1>
            <h3> Ваши персональные данные: </h3>
            <p> ФИО: <?php echo $result["surname"] . " " . $result["name"] . " " . $result["patr"] ?> </p>
            <p> Пол: <?php echo $result["gend"] ?> </p>
            <p> Дата рождения: <?php echo $result["dateb"] ?> </p>
            <p> Место регистрации: <?php echo $result["placeReg"] ?></p>
            <p> Контактный номер: <?php echo $result["telNum"] ?> </p>
            <p> Местность: <?php echo ($result["terr"]) ?> </p>
            <p> Полис : <?php echo ($result["polis"]) ?> </p>
            <p> СНИЛС : <?php echo $result["SNILS"] ?> </p>
            <p> Код категории льготы: <?php echo $result["numPriv"] ?></p>
            <p> Тип документа: <?php echo $result["typeDoc"] ?></p>
            <p> Номер документа: <?php echo $result["numDoc"] ?></p>
            <form action="exitcookie.php" method="get">
                <button type="submit">Выйти</button>
            </form>
            <form action="diagnostic.php" method="get">
                <button type="submit"> Начать диагностику </button>
            </form>
    <?php
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