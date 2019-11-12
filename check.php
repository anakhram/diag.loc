<?php
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
        echo array_shift($errors);
    }
    
    ?>
