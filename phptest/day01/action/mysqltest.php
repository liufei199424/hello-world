<?php
    $con = mysql_connect("localhost","root","root");
    if (!$con) {
        echo "数据库连接失败";
    } else {
        echo "数据库连接成功";
    }

    try {
        $dbh = new PDO("mysql:host=localhost;dbname=test", 'root', 'root');
        echo "<br>本地test数据库连接成功";
    } catch (Exception $e) {
        echo "Connection error: " . $exception->getMessage();
    }

    $query = "select *
        from students";

    $students = $dbh->query($query);

    while ($row = $students->fetch(PDO::FETCH_ASSOC)) {
        $name = $row['name'];
        $address = $row['address'];

        printf("<br> Name：%s   Address：%s", $name, $address);
    }

    echo "<br>" . $dbh->errorCode();

?>
