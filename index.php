<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход в личный кабинет</title>
</head>
<body>
    
 <?php
 if($_COOKIE['id'] == ''):
     ?>
    <div class="container">
<h1>Вход в личный кабинет</h1>
<form action="auth.php" method="post">
<p>  Логин:  <input type="text" size="30" name="login" id="login"></p>
<p>  Пароль:  <input type="password" size="30" name="pass" id="pass"></p>
<p>
    <button type="submit">Войти</button>
</p>
</form>
<form action="/registr.php">
<p> Нет учетной записи?
    <button type="submit">Зарегистрироваться</button>
</p>
</form>
    </div>
    <?php else: ?>
    <p>Привет <?=$_COOKIE['id']?>. Удалить <a href="exitcookie.php">куки</a>.<p>
    <?php endif;?>
</body>
</html>
