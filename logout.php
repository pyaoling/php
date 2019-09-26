<?php
// 开启 session
session_start();
// 禁止非法调用
define("IN_TG",true);
// 引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';

// 退出登录
_unsetcookies();
?>