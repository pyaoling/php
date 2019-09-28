<?php


// 禁止非法调用
if(!defined("IN_TG")){
	exit("Access Defined");
};

// 判断_alert_back()这个函数存不存在，因为是在别的文件中引进来的
if(!function_exists('_alert_back')){
	exit("_alert_back()函数不存在，请检查！");
}

if (!function_exists('_mysql_string')) {
	exit("_mysql_string()函数不存在，请检查");
}

function _check_uniqid($_first_uniqid,$_end_uniqid){
	// _alert_back($_first_uniqid.'\n'.$_end_uniqid);
	if(strlen($_first_uniqid)!=40||($_first_uniqid!=$_end_uniqid)){
		_alert_back("唯一标识符异常");
	}
	return _mysql_string($_first_uniqid);
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
	// 限制敏感用户名（当前是模拟，以后要从数据库中提取）	
	$_mg[0] = '瓶子小'; 
	$_mg[1] = '药灵';
	$_mg[2] = 'yaoling';
	// 告诉用户，哪些不能注册
	$_mg_string = '';
	foreach($_mg as $value){
		$_mg_string .= '['.$value.']'.'\n';
	}
	// 这里采用的是绝对匹配
	if(in_array($_string,$_mg)){
		_alert_back($_mg_string."敏感用户名不得注册");
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
@param string $_first_pass
@param string $_end_pass
@param int $_min_num
@return string $_first_pass 返回一个加密后密码
*/
function _check_password($_first_pass,$_end_pass,$_min_num){
	if(strlen($_first_pass)<$_min_num){
		_alert_back("密码不得小于".$_min_num."位");
	}
	// 密码和密码确认必须一致
	if($_first_pass!=$_end_pass){
		_alert_back("密码和确认密码不一致");
	}
	// 返回加密后的密码
	return sha1($_first_pass);
}

// 修改密码
function _check_modify_password($_string,$_min_num){
	// 判断密码
	if(!empty($_string)){
		if(strlen($_string) < $_min_num){
			_alert_back("密码不得小于".$_min_num."位");
		}
	}else{
		return null;
	}
	return sha1($_string);
}


/*
_check_question 返回密码提示
@param string $_string
@param int $_min_num
@param int $_max_num
@return string $_string返回转义后的密码提示
*/
function _check_question($_string,$_min_num,$_max_num){
	// 两边空格的删除减
	$_string = trim($_string);
	// 长度小于4位或者大于20位
	if(mb_strlen($_string,'utf-8')<$_min_num||mb_strlen($_string,'utf-8')>$_max_num){
		_alert_back("密码提示长度不能小于".$_min_num."位或者大于".$_max_num."位");
	}
	// 返回转义后的密码提示，因为是要写到数据库里面去的
	// return mysql_real_escape_string($_string);
	return _mysql_string($_string);
}

function _check_answer($_ques,$_answ,$_min_num,$_max_num){
	// 去掉两边的空格
	$_answ = trim($_answ);
	// 长度不能小于4位或者大于20位
	if(mb_strlen($_answ,'utf-8')<$_min_num||mb_strlen($_answ,'utf-8')>$_max_num){
		_alert_back("密码回得不得小于".$_min_num."位或者大于".$_max_num."位");
	}
	// 密码提示与回答不得一致
	if($_ques==$_answ){
		_alert_back("密码提示与回答不得一致");
	}
	// 返回加密后的密码回答（返回相当于个密码），因为要写到数据库里面的
	return _mysql_string(sha1($_answ));
}


/*
_check_sex 性别
@param string $_string
@return string 
*/ 
function _check_sex($_string){
	return _mysql_string($_string);
}


/*
_check_face 头像
@access public
@param string $_string
@return string
*/
function _check_face($_string){
	return _mysql_string($_string);
}

/*
_check_email()检查邮箱是否合法
@access public
@param string $_string 提交的邮箱地址
@return string $_string 返回验证后的邮箱
*/
function _check_email($_string,$_min_num,$_max_num){	
	// 邮箱是可选项，如果不为空就去处理邮箱验证，如果为空就不处理
	// if(empty($_string)){
	// 	return null;
	// }else{
		// [a-zA-Z0-9] => \w
		// @之后[\w\-\.] 可能是16.3
		// \.[\w+] 最尾部如果是.com.cn  .com.js.cn 怎么办？ 用括号(\.\w+)  就变成.com最外面括号的+ 可以是多个 .com.com.com.com.cn.cn.net.js.css
		if(!preg_match('/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/',$_string)){
			_alert_back("邮件格式不正确");
		}	

		if(strlen($_string)<$_min_num||strlen($_string)>$_max_num){
			_alert_back("邮件长度最小为6位，最大为40位");
		}
		return _mysql_string($_string);
	// }	

}

/*
_check_qq qq认证
@access public
@param int $_string 转过来是int类型，不过它已经是字符串了
@return int $_string
*/
function _check_qq($_string){
	if(empty($_string)){
		return null;
	}else{
		// [0-9] => \d
		if(!preg_match('/^[1-9]{1}[\d]{4,10}$/',$_string)){
			_alert_back("QQ号码格式不正确");
		}
	}
	return _mysql_string($_string);
}

/*
_check_url 网址认证
@access public
@param string $_string
@return  string $_string 返回验证后的网站
*/
function _check_url($_string,$_max_num){
	if(empty($_string)||($_string=='http://')){
		return null;
	}else{
		// http://www.hao9669.com
		// ?表示：0次或者1次
		// https://中的// 需要转义 \/\/
		// (\w+\.) 想要多一个字母就需添加+号
		// 后面的9669.com 跟email的尾部是一样
		if(!preg_match('/^(http(s)?:\/\/)?(\w+\.)?[\w\-\.]+(\.\w+)+$/',$_string)){
			_alert_back("网址格式不正确");
		}
		if(strlen($_string)>$_max_num){
			_alert_back("网址长度不能大于40位");
		}
	}
	return _mysql_string($_string);
}
?>