<?php
    try {
        $dbh = new PDO("mysql:host=localhost;dbname=test", 'root', 'root');
    } catch (Exception $e) {
        echo "Connection error: " . $e->getMessage();
    }

    $query = "select *
        from students";

    $students = $dbh->query($query);

    while ($row = $students->fetch(PDO::FETCH_ASSOC)) {
        $name = $row['name'];
        $address = $row['address'];

        printf("<br> Name：%s   Address：%s", $name, $address);
    }
?>
