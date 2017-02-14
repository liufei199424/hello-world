<!DOCTYPE HTML>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<title>学生列表</title>
<meta name="viewport" content="initial-scale=1.0, minimum-scale=0.5, maximum-scale=1.0, user-scalable=1">
<style>
.span-blue
{
    color: #336699;
    padding: 3px 5px 3px 5px;
    margin: 2px 2px 2px 2px;
    border-radius: 3px;
    border: 1px solid #336699;
    display: inline-block;
}
</style>
</head>
<body>
<div>
    <div>
        | 学生列表 Students <a href="../../action/mysql/list.php">刷新列表</a>
    </div><br>
    <a class="span-blue" href="../../tpl/mysql/add.tpl.php" >
        +添加学生
    </a>
    <table border=1 cellspacing=0 width=40% bordercolorlight=#333333 bordercolordark=#efefef >
        <?php
            $students = unserialize(base64_decode($_GET['students']));

            foreach ($students as $a) {
                ?>
                    <tr>
                        <td><?=$a['id']?></td>
                        <td><?=$a['name']?></td>
                        <td><?=$a['address']?></td>
                        <td>
                            <a href="../../tpl/mysql/modify.tpl.php?id=<?=$a['id']?>&name=<?=$a['name']?>&address=<?=$a['address']?>">修改</a>
                            <a href="../../action/mysql/delete.php?id=<?=$a['id']?>">删除</a>
                        </td>
                    </tr>
                <?php
            }
        ?>
    </table>
</div>
<script src="../../static/js/jquery-2.1.4.min.js"></script>
<script>
    $(function(){
    });
</script>
</body>
</html>
