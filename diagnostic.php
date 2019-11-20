<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <title>Диагностика</title>
</head>

<body>
    <h2> Выберите из данного списка, беспокоющие вас, симптомы или опишите их своими словами*:</h2>
    <?php
    $mysql = new mysqli('localhost', 'root', '', 'registr-bd');
    $query = mysqli_query($mysql, 'SELECT * FROM `attributes`');
    ?>
    <form action="intensity.php" method="post">
        <?php
        while ($rows = mysqli_fetch_assoc($query)) { ?>
            <p><input type="checkbox" name="attributes[<? echo $rows['idA'] ?>]" value="<?php echo $rows['idA'] ?>">
                <?php echo $rows["idA"] . " " . $rows["nameA"] ?> </p>
        <?php
        }
        ?>
        <p><input type="submit" value="Отправить"></p>
    </form>
    <form action="manual.php" method="get">
        <p> <input type="submit" value="Добавить"></p>
    </form>
    <?php
    if ($mysql->connect_errno) {
        echo "Не удалось подключиться: %s\n";
        exit();
    }
    $mysql->close();
    ?>
    <h5> *нажмите "Добавить"</h5>
</body>

</html>