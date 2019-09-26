<?php

/*
_setcookies 生成cookie
@param 
*/ 
function _setcookies($_username,$_uniqid,$_time){
	switch($_time){
		case '0': // 浏览器进程
			setcookie("username",$_username);
			setcookie("uniqid",$_uniqid);
			break;
		case '1':
			// 时间是从秒开始算的  1天 86400 秒
			setcookie('username',$_username,time()+60*60*24);// 
			setcookie('uniqid',$_uniqid,time()+60*60*24);
			break;
		case '2': // 1周	 604800	秒	
			setcookie('username',$_username,time()+60*60*24*7);
			setcookie('uniqid',$_uniqid,time()+60*60*24*7);
			break;
		case '3': // 1月 2592000 秒
			setcookie('username',$_username,time()+60*60*24*7*30);			
			setcookie('uniqid',$_uniqid,time()+60*60*24*7*30);
			break;
	}
}

/*
_check_username表示检测用户名
@param string $_string 受污染的用户名
@param int $_min_num 最小位数
@param int $_max_num 最大位数
@return string 过滤后的用户名
*/
function _check_username($_string,$_min_num,$_max_num){
	// 去掉两边的空格
	$_string = trim($_string);
	// 长度小于两位或者大于20位都不行
	if(mb_strlen($_string,'utf-8')<$_min_num||mb_strlen($_string,'utf-8')>$_max_num){			
			_alert_back("用户名长度不能小于".$_min_num."位或者大于".$_max_num."位不正确");
	}
	// 限制敏感字符
	$_char_pattern='/[<>\'\"\ ]/';
	if(preg_match($_char_pattern,$_string)){
		_alert_back("用户名不得包含敏感字符,如：\'\" < > 小空格 大空格");
	}
	
	// 将用户的数据都过滤掉（转义）
	// 听说这个函数对数据库连接有问题，只是听说
	// 将用户名转义输入
	// 有两个参数，和二个参数是可选的，是数据的句柄，如果不写就是上一次连接最近的那个句柄（变量）
	return _mysql_string($_string);
}

/*
_check_password验证密码
@access public
@param int $_min_num
@return string $_first_pass 返回一个加密后密码
*/
function _check_password($_string,$_min_num){
	if(strlen($_string) < $_min_num){
		_alert_back("密码不得小于".$_min_num."位");
	}
	// 返回加密后的密码
	return sha1($_string);
}

function _check_time($_string){
	$_time =array('0','1','2','3');
	if(!in_array($_string,$_time)){
		_alert_back("保留出错");
	}
	return _mysql_string($_string);
}

?>