<?php

$login = trim(filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING));
$pass = trim(filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING));

$mysql = new mysqli('localhost', 'root', '', 'registr-bd');

$result = $mysql->query("SELECT * FROM `users` WHERE `login` = '$login'");
$user = $result->fetch_assoc();
if (count($user) == 0) {
    echo "Такой пользователь не найден";
    exit();
}

if (password_verify($pass, $user[pass])) {

    $res = $mysql->query("SELECT `id` FROM `users` WHERE `login` = '$login'");
    $idarr = mysqli_fetch_array($res, MYSQLI_ASSOC);
    $id = array_shift($idarr);
    setcookie('id', $id);
    header("Location: /mainpage.php");
} else {
    echo "пароль нет";
}

$mysql->close();
