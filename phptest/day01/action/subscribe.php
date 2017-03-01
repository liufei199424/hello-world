<?php
    if (isset($_POST['name'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];

        printf("姓名：%s <br>",$name);
        printf("邮箱：%s <br>",$email);
    }

    if (isset($_GET['name'])) {
        $name = $_GET['name'];
        $email = $_GET['email'];

        printf("姓名：%s <br>",$name);
        printf("邮箱：%s <br>",$email);
    }

    echo "POST请求：";
    print_r($_POST);
    echo "<br>";

    echo "GET请求：";
    print_r($_GET);
?>
