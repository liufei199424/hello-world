<?php
    require_once("../../util/util.php");

    $con = mysql_connect("localhost", "root", "root");
    if (!$con) {
        die("连接失败：" . mysql_errno());
    }

    mysql_select_db("test", $con);

    $id = $_GET['id'];

    $sql = " delete from students
        where id = '$id' ";

    mysql_query($sql);

    mysql_close();

    setJump("list.php");
?>
