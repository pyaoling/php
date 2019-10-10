<?php

if(!defined("IN_TG")){
	exit("非法调用");
}

//转换成硬路径常量速度更快
define('ROOT_PATH',substr(dirname(__FILE__),0,-8));

// 创建一个自动转义状态的常量
define('GPC',get_magic_quotes_gpc());

//拒绝PHP的低版本
if(PHP_VERSION<'4.1.0'){
	exit("Version is to Low");
}
// 设置字符集编码
header("content-type:text/html;charset=utf8");

//引入核心函数库
require ROOT_PATH.'includes/global.func.php';
require ROOT_PATH.'includes/mysql.func.php';

// 执行耗时开始时间
define('START_TIME',_runtime());

// 数据库连接
define("DB_HOST","localhost");
define("DB_USER","roodst");
define("DB_PWD","root");
define("DB_NAME","test");
// 连接数据库
_connect();
// 创建数据库
_select_db();
//  设置字符集
_set_names();

// 短信提醒  取得字段的总和
$_message = _fetch_array("SELECT 
					count(tg_id)
				AS 
					count 
				FROM 
					tg_message 
				WHERE 
					tg_state = 0
				");
if(empty($_message['count'])){
	$_message_html='<strong><a href="member_message.php">'.(0).'</a></strong>';
}else{
	$_message_html = '<strong><a href="member_message.php">'.($_message['count']).'</a></strong>';
}


?>