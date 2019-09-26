<?php
// 开启SESSION
session_start();
// 禁止非法调用
define("IN_TG",true);
// 在本页有效的CSS
define("SCRIPT","login");

// 引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';
// 如果为登录状态不可能进行本页面
_login_state();
// 处理登录状态
if(@$_GET['action'] == 'login'){
	// 防止恶意注册和跨战攻击
	_check_code($_POST['code'],$_SESSION['code']);
	// 引入验证文件
	include ROOT_PATH.'includes/login.func.php';
	// 接收数据
	$_clean = array();
	$_clean['username'] = _check_username($_POST['username'],2,20);
	$_clean['password'] = _check_password($_POST['password'],6);
	$_clean['time'] = _check_time($_POST['time']);
	print_r($_clean);
	// 到数据库去验证
	if(!!$_rows = _fetch_array("SELECT tg_username,tg_uniqid FROM tg_user WHERE tg_username='{$_clean['username']}' and tg_password='{$_clean['password']}' and tg_active='' LIMIT 1")){
		echo "登录成功";
		echo $_rows['tg_username']."<br/>";
		echo $_rows['tg_uniqid'];
		// 也需要关闭数据库
		_close();
		// 清空验证码的SESSION
		_session_destroy();
		// 设置cookie
		_setcookies($_rows['tg_username'],$_rows['tg_uniqid'],$_clean['time']);
		_location(null,"index.php");		
	}else{
		// 关闭数据库
		_close();
		// 登录成功要清空验证码的SESSION
		_session_destroy();
		_location("用户名密码错误或者该帐户未被激活","login.php");
	}
}

?>

<title>登录</title>
<meta charset="utf-8"/>
<?php require ROOT_PATH.'includes/title.inc.php';?>
<script type="text/javascript" src="js/code.js"></script>
<script type="text/javascript" src="js/login.js"></script>
<?php require ROOT_PATH."includes/header.inc.php";?>

<div class="login">
	<h2>登录</h2>
	<form method="post" name="login" action="login.php?action=login">
		<dl>
			<dd>用户名：<input type="text" class="text" name="username"/></dd>
			<dd>密码：<input type="password" name="password" class="text"/></dd>
			<dd>
				不保留<input type="radio" name="time" checked="checked" value="0"/>
				保留1天<input type="radio" name="time" value="1"/>
				保留1周<input type="radio" name="time" value="2"/>
				保留1月<input type="radio" name="time" value="3"/>
			</dd>		
			<dd>验证码：<input type="text" name="code" class="code"/>
				<img src="code.php" id="code">
			</dd>
			<dd>
				<input type="submit" value="登录" name="submit" class='button'/>
				<input type="button" value="注册" name="register" id="location" class='button'/>
			</dd>
		</dl>		
	</form>
</div>

<?php require ROOT_PATH."includes/footer.inc.php";?>