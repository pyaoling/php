<?php

// 防止恶意调用
if(!defined('IN_TG')){
	exit("非法调用");
}

/*
_runtime()是用来获取执时耗时的
@access public 表示函数对外公开
@return float 表示返回的是一个浮点型数字
*/ 
function _runtime(){
	$_mtime = explode(' ',microtime());
	return $_mtime[1] + $_mtime[0];
}

/*
_alert_back()表示JS弹窗
@access public
@param $_info
@return void弹窗
*/
function _alert_back($_info){
	echo "<script>alert('".$_info."');history.back();</script>";
	exit();
}


// 弹出之后关闭自己
function _alert_close($_info){
	echo "<script>alert('".$_info."');window.close();</script>";
}


/*

*/ 
function _location($_info,$_url){
	if(!empty($_info)){
		echo "<script>alert('$_info');location.href='$_url';</script>";
		exit();
	}
	else{
		header("Location:".$_url);
	}
}

// 防止登录后，又可以注册和登录
function _login_state(){
	if(isset($_COOKIE['username'])){
		_alert_back("登录状态无法进行本操作");
	}
}

/*判断唯一标识符异常*/
function _uniqid($_mysql_uniqid,$_cookie_uniqid){
	if($_mysql_uniqid != $_cookie_uniqid){
		_alert_back("唯一标识符异常");
	}
}

/*
_title()标题截取函数
*/
function _title($_string){
	if(mb_strlen($_string,'utf-8') > 14){
		$_string = mb_substr($_string,1,14,'utf-8').'……';
	}
	return $_string;
}


/*
_html()函数表示对字符串进行HTML过滤显示
如果是数组按数组的方式过滤，如果单独的字符串就按单独的字符串来过滤
*/
function _html($_string){
	if(is_array($_string)){
		foreach($_string as $_key => $_value){
			$_string[$_key] = htmlspecialchars($_value);
		}
	}else{
		$_string = htmlspecialchars($_string);
	}
	return $_string;
}



/*
_mysql_string
@param string $_string
@return string $_string
*/
function _mysql_string($_string){
	// get_magic_quotes_gpc，on off默认是开启的，如果想关掉，必须在php。ini关闭它
	// get_magic_quotes_gpc() 如果开启状态，那么就不需要转义
	// 如果没有开启，就转义
	if(!GPC){
			//return mysql_real_escape_string($_string);	
		if(is_array($_string)){
			foreach($_string as $_key=>$_value){
				$_string[$_key]=_mysql_string($_value);
			}
		}else{
			$_string = mysql_real_escape_string($_string);
		}		
		return $_string;
	}
}

/*
$_sql 获取所有的字段(总条数)
$_size 1页里面有多少条
*/
function _page($_sql,$_size){
	// global 将变量全部取出来，外部可以访问
	global $_page,$_pagesize,$_pagenum,$_pageabsolute,$_num;;
	//分页模块
	global $_pagesize,$_pagenum;
	if(isset($_GET['page'])){
		$_page = $_GET['page'];
		if(empty($_page) || $_page < 0 || !is_numeric($_page)){
			$_page = 1;
		}else{
			$_page = intval($_page);
		}
	}else{
		$_page = 1;
	}
	$_pagesize = $_size;
	// 获得所有的页面的总和
	$_num = _num_rows(_query($_sql));
	if($_num == 0){
		// 如果数据库里面一条数据都没有，默认就是第一页
		$_pageabsolute = 1;
	}else{
		// 如果有值求出总页数
		// 获得页面：总数除以每页多少条
		$_pageabsolute = ceil($_num / $_pagesize);
	}
	// 如果当面的页数大于总页码,就把总页面的值赋给当前页码
	if($_page > $_pageabsolute){
		$_page = $_pageabsolute;
	}
	$_pagenum = ($_page-1)*$_pagesize;

}


/*
_paging 分页函数
@param $_type
@return 返回分页
type = 1 数字分页
type = 2 文本分页
*/
function _pageing($_type){
	// 通过全局变量global来得到另外一个页面的值，避免传很多值
	global $_page,$_pageabsolute,$_num;
	if($_type ==1){
		// 数字分页
		echo '<div class="page_num">';
		echo '<ul>';
		for($i=0;$i<$_pageabsolute;$i++){
			if($_page == ($i+1)){
				echo "<li><a href='".SCRIPT.".php?page=".($i+1)."' class='selected'>".($i+1)."</a></li>";
			}else{
				echo "<li><a href='".SCRIPT.".php?page=".($i+1)."'>".($i+1)."</a></li>";
			}
			
		}
		echo "</ul>";
		echo "</div>";
	}elseif($_type == 2){
		// 文本分页
		echo '<div class="page_text">';
		echo '<ul>';
		echo '<li>'.$_page.'/'.$_pageabsolute.'页|</li>';
		echo '<li>共有<strong>'.$_num.'</strong>条数据</li>';
			//首页
			if($_page == 1){
				echo "<li>首页</li>";
				echo "<li>上一页</li>";
			}else{
				echo "<li><a href='".SCRIPT.".php'>首页</a></li>";
				echo "<li><a href='".SCRIPT.".php?page=".($_page-1)."'>上一页</a></li>";
			}
			// 尾页
			if($_page == $_pageabsolute){
				echo "<li>下一页</li>";
				echo "<li>尾页</li>";
			}else{
				echo "<li><a href='".SCRIPT.".php?page=".($_page+1)."'>下一页</a></li>";
				echo "<li><a href='".SCRIPT.".php?page=".$_pageabsolute."'>尾页</a></li>";
			}
		echo '</ul>';
		echo '</div>';
	}
}


// 清空SESSION
function _session_destroy(){
	// 如果开启了才销毁
	if(session_start()){
		session_destroy();
	}	
}

// 清空cookie
function _unsetcookies(){
	setcookie('username','',time()-1);
	setcookie('uniqid','',time()-1);
	// 最后把session也一起清空
	_session_destroy();
	// 完成跳转
	_location(null,'index.php');
}

function _sha1_uniqid(){
	return _mysql_string(sha1(uniqid(rand(),true)));
}



/*
_check_code
@param string $_first_code
@_param string $_end_code
@return void 验证码比对
*/ 
function _check_code($_first_code,$_end_code){
	if($_first_code!=$_end_code){
		_alert_back("验证码不正确啊");
	}
}

/*
@access public
@param int $_width 表示验证码的长度
@param int $_height 表示验证码的高度
@param int $_rand_code 表示验证码的位数
@param bool $_flag 表示是否显示边框
@return void 这个函数执行后产生一个验证码
*/
function _code($_width=75,$_height=25,$_rnd_code=4,$_flag=false){

// 创建随机码
$_nmsg = "";
for($i = 0; $i < $_rnd_code;$i++){
	// 将0到15转抽成16进制
	$_nmsg .= dechex(mt_rand(0,15));
}
$_SESSION['code'] = $_nmsg;


// 创建一张图像
$_img = imagecreatetruecolor($_width,$_height);
// 创建一个白色背景
$_white = imagecolorallocate($_img,255,255,255);
// 填充
imagefill($_img,0,0,$_white);

// 黑色边框
if($_flag){
	$_black = imagecolorallocate($_img,0,0,0);
	imagerectangle($_img,0,0,$_width-1,$_height-1,$_black);
}


// 随机画出6个线条
for($i=0;$i<6;$i++){
	$_md_color = imagecolorallocate($_img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
	imageline($_img,mt_rand(0,$_width),mt_rand(0,$_height),mt_rand(0,$_width),mt_rand(0,$_height),$_md_color);
}

// 随机雪花
for($i=0;$i<100;$i++){
	$_rnd_color = imagecolorallocate($_img,mt_rand(200,255),mt_rand(200,255),mt_rand(200,255));
	imagestring($_img,1,mt_rand(1,$_width),mt_rand(1,$_height),'*',$_rnd_color);
}

// 输出验证码
for($i=0;$i<strlen($_SESSION['code']);$i++){
	// 随机颜色
	$_rnd_color = imagecolorallocate($_img,mt_rand(0,100),mt_rand(0,200),mt_rand(0,250));
	// 5:5号字体
	imagestring($_img,5,$i*$_width/$_rnd_code+mt_rand(1,10),mt_rand(1,$_height/2),$_SESSION['code'][$i],$_rnd_color);

}

// 输出图像指定标头  指定什么类型的图片
header("Content-Type:image/png");
// 按照png的图片输出到浏览器文件
imagepng($_img);
// 用完之后要消毁，虽然是存放在服务端
imagedestroy($_img);
}


?>