<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <title>Интенсивность</title>
</head>

<body>
    <h2> Выберите интенсивность каждого из ваших симптомов:</h2>
    <?php
    $mysql = new mysqli('localhost', 'root', '', 'registr-bd');

    //TODO $query = mysqli_query($mysql, 'SELECT * FROM `attributes`');

    $attributesIds = $_POST['attributes'];
    foreach ($attributesIds as $i) {
        $attributes = mysqli_query($mysql, "SELECT nameA FROM `attributes` WHERE `idA` = '$attributesIds[$i]'");
        while ($attributesNames = mysqli_fetch_assoc($attributes)) {
            echo $attributesNames['nameA']?>: </br> <?;
            $strName = $attributesIds[$i].'_';
            $tables = mysqli_query($mysql, "SHOW TABLES FROM `registr-bd`");
            while ($tablesArr = mysqli_fetch_assoc($tables)) {
                foreach ($tablesArr as $tableName) {
                    if (strncmp($tableName, $strName, strlen($strName)) === 0) {?></br> 
                        <?php 
                            $query = mysqli_query($mysql, "SELECT * FROM `$tableName`");
                            while ($intensies = mysqli_fetch_assoc($query)){
                                $intensityName = $intensies["intensity"];
                                //echo $intensityName;
                            }
                        ?>
                        <form action = 'writeToBase.php' method = 'post'>
                            <p>
                                <select>
                                <!-- <option disabled>Выберите интенсивность</option> -->
                                <?php for ($value = 0; $value < count($intensityName); $i++){   ?>
                                     <option value = "<?php echo $value?>"> <?php echo $value?> </option>
                                <?php  }  ?>
                                </select>
                            </p>
                        </form>
                        
                        <?php 
                    }
                }
            }
        }
    }
?>
</body>

</html>