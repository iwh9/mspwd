<?php
header("content-type:text/html;charset=utf-8");
define("SET_URL","http://".$_SERVER['SERVER_NAME']."/");//上传到空间（服务器）修改自己的域名
define('BIND_MODULE', 'Home');

define("HOMECSS_URL", SET_URL."public/home/css");//使用 {$Think.const.CSS_URL} 
define("HOMEIMG_URL", SET_URL."public/home/img");
define("HOMEJS_URL", SET_URL."public/home/js");

define('APP_DEBUG', true);	//开启调试模式

if(PHP_VERSION>=7 and PHP_VERSION<=5.5){
    echo "该系统不支持PHP7，请将PHP版本设置成5.5.6为最佳！";
    die;
}
include "./App/ThinkPHP.php";//引入ThinkPHP核心文件



//{$Think.const.CSS_URL} 指向的路径是：http://你的域名/public/css
//下面的JS啊 lib啊Layui 啊 指向的路径是一样的
