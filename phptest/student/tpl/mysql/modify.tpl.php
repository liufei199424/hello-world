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
    <?php
        $id = $_GET['id'];
        $name = $_GET['name'];
        $address = $_GET['address'];
    ?>
    <form action="../../action/mysql/modify.php" method="post">
        ID:<input type="text" name="id" value="<?=$id?>" /><br>
        Name:<input type="text" name="name" value="<?=$name?>" /><br>
        Address:<input type="text" name="address" value="<?=$address?>" /><br>
        <input type="submit" value="修改" >
    </form>
</div>
<script src="../../static/js/jquery-2.1.4.min.js"></script>
<script>
    $(function(){
    });
</script>
</body>
</html>
