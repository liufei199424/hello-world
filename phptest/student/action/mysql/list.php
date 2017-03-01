<?php
    require_once("../../util/util.php");

    // mysql_connect(servername,username,password);
    $con = mysql_connect("localhost", "root", "root");
    if (!$con) {
        die("Could not Connection: " . mysql_errno());
    }

    // 选择数据库
    mysql_select_db("test", $con);

    // sql
    $sql = " select *
        from students order by id";

    // 查询结果集
    $result = mysql_query($sql);

    $students = array();
    // 遍历结果集
    while ($row = mysql_fetch_array($result)) {
        $students[] = $row;
    }

    // 关闭结果集
    mysql_free_result($result);

    // 关闭数据库
    mysql_close();

    setJump("../../tpl/mysql/list.tpl.php?students=" . base64_encode(serialize($students)));
?>
