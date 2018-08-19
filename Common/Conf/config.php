<?php
return array(
	//'配置项'=>'配置值'
	'URL_MODEL'   => 2,  //URL 模式，不建议更改
	'DEFAULT_FILTER'        =>  'strip_tags,stripslashes',
	'SHOW_PAGE_TRACE'   => false,//tp3.2右下角提示是否开启
	'URL_CASE_INSENSITIVE'  =>  true, 
	'DB_TYPE'		=> 'mysql',//数据库链接类型
	'DB_HOST'		=> 'localhost',//数据库链接地址
	'DB_NAME'		=> '',//数据库名
	'DB_USER'		=> '',//数据库用户名
	'DB_PWD'		=> '',//数据库密码
	'DB_PORT'		=> '3306',//数据库端口
	'DB_PREFFIX'	=> 'm_',//数据库表前缀
	'DB_PARAMS'		=> 'array()',
	'DB_DEBUG'		=> true,//数据库调试模式，不建议更改
	'DB_CHARSET'	=> 'utf8',//数据库编码
	//'DEFAULT_V_LAYER'       =>  'Template',
	
	
	/*'TMPL_EXCEPTION_FILE' => './Home/View/Public/404.html',*/
	'TMPL_ACTION_SUCCESS'=>'Public:dispatch_jump',
    'TMPL_ACTION_ERROR'=>'Public:dispatch_jump',
);
