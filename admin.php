<?php
header("content-type:text/html;charset=utf-8");
define("SET_URL","http://".$_SERVER['SERVER_NAME']."/");//上传到空间（服务器）修改自己的域名
define('BIND_MODULE','Admin');
define('APP_DEBUG', true);	//开启调试模式
define("ADMIN_URL", SET_URL."public/admin/");
if(PHP_VERSION>=7 and PHP_VERSION<=5.5){
    echo "该系统不支持PHP7，请将PHP版本设置成5.5.6为最佳！";
    die;
}
include "./App/ThinkPHP.php";//引入ThinkPHP核心文件
