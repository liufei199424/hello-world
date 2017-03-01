<?php
    require_once("../../util/util.php");

    $con = mysql_connect("localhost", "root", "root");
    if (!$con) {
        die("连接失败：" . mysql_errno());
    }

    mysql_select_db("test", $con);

    $id = $_POST['id'];
    $name = $_POST['name'];
    $address = $_POST['address'];

    $sql = " insert into students (id, name, address)
        values ('$id','$name','$address') ";

    $result = mysql_query($sql);

    setJump("list.php");
?>
