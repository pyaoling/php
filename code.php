<?php
header("content-type:text/html;charset=utf-8");
// 开启session
session_start();

// 防止恶意调用
define("IN_TG",true);

// 引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';

// 去行验证码函数
// 函数叁数_code(宽度，高度，位数，边框是否要)
// 验证码大小为：75*25，如果不填默认是4位
// 如果是6位，长度推荐为125，如果8位，推荐175
// 第四位参数：是否需要边框，要的话，true,不要为false,默认为false
// 可能通过数据库的方法，来设置验证码的各种属性
_code(100,25,4,true);


?>




