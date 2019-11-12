<?php

    $data = $_POST;
    if (isset($data['dosignup'])){
        $login = trim(filter_input(INPUT_POST, 'login',FILTER_SANITIZE_STRING));
        $pass = filter_input(INPUT_POST, 'pass',FILTER_SANITIZE_STRING);
        $pass2 = filter_input(INPUT_POST, 'pass2',FILTER_SANITIZE_STRING);

        $name= trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
        $surname = trim(filter_input(INPUT_POST,'surname',FILTER_SANITIZE_STRING));
        $patr = trim(filter_input(INPUT_POST,'patr',FILTER_SANITIZE_STRING));
        $gend = trim(filter_input(INPUT_POST,'gend',FILTER_SANITIZE_STRING));
        $dateb = trim(filter_input(INPUT_POST,'dateb',FILTER_SANITIZE_STRING));

        $placeReg = (filter_input(INPUT_POST,'subRF',FILTER_SANITIZE_STRING)) . ' ';
        $placeReg .= (filter_input(INPUT_POST,'areaRF',FILTER_SANITIZE_STRING)) . ' ';
        $placeReg .= (filter_input(INPUT_POST,'cityRF',FILTER_SANITIZE_STRING)). ' ';
        $placeReg .= (filter_input(INPUT_POST,'townRF',FILTER_SANITIZE_STRING)) . ' ';
        $placeReg .= (filter_input(INPUT_POST,'streetRF',FILTER_SANITIZE_STRING)) . ' ';
        $placeReg .= (filter_input(INPUT_POST,'houseRF',FILTER_SANITIZE_STRING)) . ' ';
        $placeReg .= (filter_input(INPUT_POST,'apartRF',FILTER_SANITIZE_STRING)) . ' ';

        $telNum = trim(filter_input(INPUT_POST,'telNum',FILTER_SANITIZE_STRING));
        $terr = trim(filter_input(INPUT_POST,'terr',FILTER_SANITIZE_STRING));
        $polis = trim(filter_input(INPUT_POST,'polis',FILTER_SANITIZE_STRING));
        $SNILS = trim(filter_input(INPUT_POST,'SNILS',FILTER_SANITIZE_STRING));
        $nameStrOrg = trim(filter_input(INPUT_POST,'nameStrOrg',FILTER_SANITIZE_STRING));
        $numPriv = trim(filter_input(INPUT_POST,'numPriv',FILTER_SANITIZE_STRING));
        $typeDoc = trim(filter_input(INPUT_POST,'typeDoc',FILTER_SANITIZE_STRING));
        $numDoc = trim(filter_input(INPUT_POST,'numDoc',FILTER_SANITIZE_STRING));

        $mysql = new mysqli('localhost','root','','registr-bd');

        if ($mysqli->connect_errno) {
            echo "Не удалось подключиться: %s\n";
            exit();
        }
        $errors = array();
        //Проверка на пользовательские данные 
        if (mb_strlen($name) < 3 || mb_strlen($name) > 90){
            $errors[] = 'Недопустимая длина имени!';
        }
        else if (mb_strlen($surname) < 2 || mb_strlen($surname) > 90){
            $errors[] = 'Недопустимая длина фамилии!';
        }
        else  if (mb_strlen($patr) < 3 || mb_strlen($patr) > 90){
            $errors[] = 'Недопустимая длина отчества!';
        }
        else if (!($gend = "женский") || !($gend = "мужской")){
            $errors[] = 'Выберете пол!';
        }
        else  if (mb_strlen($telNum) < 10 || mb_strlen($telNum) > 13){
            $errors[] = 'Недопустимая длина телефона!';
        }
        else if (!($terr = "городская") || !($terr = "сельская")){
            $errors[] = 'Выберете местность!';
        }
        else  if (mb_strlen($polis) < 15 || mb_strlen($polis) > 17){
            $errors[] = 'Недопустимая длина номера полиса!';
        }
        else  if (mb_strlen($SNILS) < 10 || mb_strlen($SNILS) > 12){
            $errors[] = 'Недопустимая длина номера СНИЛС!';
        }

          //Проверка на логин и пароль
        if (mb_strlen($login) < 5 || mb_strlen($login) > 90){
            $errors[] = 'Недопустимая длина логина!';
        }
        else if (mb_strlen($pass) < 4 || mb_strlen($pass) > 12){
            $errors[] = 'Недопустимая длина пароля (от 4 до 12 символов)!';
        }
        else if ($pass2 != $pass){
            $errors[] = 'Пароли не совпадают!';
        }

        if (empty($errors)){
        $pass = password_hash($pass,PASSWORD_DEFAULT);

        $mysql->query("INSERT INTO `users` (`login`,`pass`,`name`,`surname`,`patr`,`gend`,`dateb`,`placeReg`,`telNum`,`terr`,`polis`,`SNILS`,`nameStrOrg`,`numPriv`,`typeDoc`,`numDoc`) VALUES('$login','$pass','$name','$surname','$patr','$gend','$dateb','$placeReg','$telNum','$terr','$polis','$SNILS','$nameStrOrg','$numPriv','$typeDoc','$numDoc')");

        $mysql->close();

        header('Location: /');
        }else
        {
            echo '<div style="color: red;">' .array_shift($errors) . '</div><hr>';
        }
    }
?>


<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
</head>
<body>
<h1>  Регистрация</h1>
<h2><p>  Персональные данные:</p></h2>
    <p>Эти данные будут отображаться в личном кабинете.</p>
    <form action="" method="post">
<p>  Имя:  <input type="text" size="30" name="name" id="name" value="<?php echo $name; ?>"></p>
<p>  Фамилия:  <input type="text" size="30" name="surname" id="surname" value="<?php echo $surname; ?>"></p>
<p>  Отчество:  <input type="text" size="30" name="patr" id="patr" value="<?php echo $patr; ?>"></p>

<p>  Пол: <select name="gend">
        <option>Выберете</option>
        <option>Женский</option>
        <option>Мужской</option>
    </select></p>
<p>  Дата рождения:  <input type="date" id="dateb" name="dateb" value="<?php echo $dateb; ?>"></p>
<p>Место регистрации: субъект Российской Федерации <input type="text" size="30" name="subRF" id="subRF" value="<?php echo $subRF; ?>"> , район <input type="text" size="30" name="areaRF" id="areaRF" value="<?php echo $areaRF; ?>"> , город <input type="text" size="30" name="cityRF" id="cityRF" value="<?php echo $cityRF; ?>"> ,<br><br> населенный пункт <input type="text" size="30" name="townRF" id="townRF" value="<?php echo $townRF; ?>"> , улица <input type="text" size="30" name="streetRF" id="streetRF" value="<?php echo $streetRF; ?>"> , дом <input type="text" size="30" name="houseRF" id="houseRF" value="<?php echo $houseRF; ?>">, квартира <input type="text" size="30" name="apartRF" id="apartRF" value="<?php echo $apartRF; ?>"> , тел. <input type="tel"  placeholder="8(900)123-45-67" pattern="\8[\(]{0,1}9[0-9]{2}[\)]{0,1}?\d{3}[-]{0,1}\d{2}[-]{0,1}\d{2}" name="telNum" id="telNum" value="<?php echo $telNum; ?>"></p>
<p>Местность:
    <select name="terr">
    <option>Выберете</option>
    <option>городская</option>
    <option>сельская</option>
</select></p>
<p>Полис ОМС: <input type="text" size="30" pattern="[0-9]{16}"  name="polis" id="polis" value="<?php echo $polis; ?>">  </p>
<p>СНИЛС: <input type="text" size="30" name="SNILS" id="SNILS" value="<?php echo $SNILS; ?>"></p>
<p>Наименование страховой медицинской организации <input type="text" size="30" name="nameStrOrg" id="nameStrOrg" value="<?php echo $nameStrOrg; ?>"></p>
<p>Код категории льготы <input type="text" size="5" name="numPriv" id="numPriv" value="<?php echo $numPriv; ?>"></p>
<p>Документ <input type="text" size="30" name="typeDoc" id="typeDoc"> : <input type="text" size="30" name="numDoc" id="numDoc" value="<?php echo $numDoc; ?>"></p>

<h2><p> Данные для входа в личный кабинет: </p></h2>
    <p>Запомните логин и пароль.</p>
<p>  Логин:  <input type="text" size="30" name="login" id="login" value="<?php echo $login; ?>"></p>
<p>  Пароль:  <input type="password" size="30" name="pass" id="pass"></p>
Повторите пароль
<p>  Пароль:  <input type="password" size="30" name="pass2" id="pass"></p
<p>
    <button type="submit" name = "dosignup">Зарегистрироваться</button>
</p>
    </form>
</body>
</html>