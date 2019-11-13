<?php

setcookie('id', $user[name],time()- 60, "/");
header('Location: /');
