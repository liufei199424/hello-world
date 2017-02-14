<?php

    $users = fopen("user.txt", "r");

    while ($line = fgets($users, 4096)) {
        list($name, $age, $sex) = explode("|", $line);

        printf("姓名：%s\n", $name);
        printf("年龄：%s\n", $age);
        printf("性别：%s", $sex);
    }

?>
