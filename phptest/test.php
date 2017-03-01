<?php
    $a = 1;
    $b = 0;

    $c = $a / $b;

    error_log("错误了啊");
?>

#定义变量 $path_info
set $path_info "";
#定义变量 $real_script_name，用于存放真实地址
set $real_script_name $fastcgi_script_name;
#如果地址与引号内的正则表达式匹配
if ($fastcgi_script_name ~ "^(.+?\.php)(/.+)$") {
        #将文件地址赋值给变量 $real_script_name
        set $real_script_name $1;
        #将文件地址后的参数赋值给变量 $path_info
        set $path_info $2;
}
#配置fastcgi的一些参数
fastcgi_param SCRIPT_FILENAME $document_root$real_script_name;
fastcgi_param SCRIPT_NAME $real_script_name;
fastcgi_param PATH_INFO $path_info;

set $real_script_name $fastcgi_script_name;
　　set $path_info ””;
　　if ( $fastcgi_script_name ~ "^(.+?.php)(/.+)$"){
　　set $real_script_name $1;
　　set $path_info $2;
　　}
　　fastcgi_param SCRIPT_NAME $real_script_name;
　　fastcgi_param PATH_INFO $path_info;
