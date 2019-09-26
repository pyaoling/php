<?php

header("content-type:text/html;charset=utf-8");

if(!defined("IN_TG")){
	exit("非法调用");
}

/*
_connect()连接MYSQL数据库
access public
@return void
*/ 
function _connect(){
	global $_conn;
	// 创建数据库连接
	if(!$_conn = mysql_connect(DB_HOST,DB_USER,DB_PWD)){
		exit("数据库连接失败");
	}
}

/*
_select_db 选择一款数据库
@return void
*/ 
function _select_db(){
	if(!mysql_select_db(DB_NAME)){
		exit("指定的数据库不存在");
	}
}

/*

*/
function _set_names(){
	if(!mysql_query('SET NAMES UTF8')){
		exit("字符集错误".mysql_error());
	}
}




/*
@param $_sql
*/ 
function _query($_sql){
	if(!$_result = mysql_query($_sql)){
		exit("sql执行失败".mysql_error());
	}
	// 要返回结果集
	return $_result;
}

/*
_fetch_array 只能获取指定数的一条数据组

*/ 
function _fetch_array($_sql){
	return mysql_fetch_array(_query($_sql),MYSQL_ASSOC);
}

/*
_fetch_array_list 可以返回指定数据的所有数据
@param $_result
*/ 
function _fetch_array_list($_result){
	return mysql_fetch_array($_result,MYSQL_ASSOC);
}


function _num_rows($_result){
	return mysql_num_rows($_result);
}

// 判断是否有数据,有就提示
function _is_repeat($_sql,$_info){
	if(_fetch_array($_sql)){
		_alert_back($_info);
	}
}


/*
_affected_rows 表示返回影响的记录数
*/
function _affected_rows(){
	return mysql_affected_rows();
}

function _close(){
	if(!mysql_close()){
		exit("数据库关闭异常");
	}
}
?>