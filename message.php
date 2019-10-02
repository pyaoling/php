<?php
session_start();
// 禁止非法调用
define("IN_TG",true);
// 在本页有效的CSS
define("SCRIPT","message");
// 引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';
// 判断是否登录
if(!isset($_COOKIE['username'])){
	_alert_close("请先登录");
}
// 写短信
if($_GET['action'] == 'write'){
	_check_code($_POST['code'],$_SESSION['code']);
	// 从tg_user表中找tg_uniqid唯一标识符
	if(!!$_rows = _fetch_array("SELECT tg_uniqid FROM tg_user WHERE tg_username='{$_COOKIE['username']}' LIMIT 1")){
		_uniqid($_rows['tg_uniqid'],$_COOKIE['uniqid']);
		include ROOT_PATH.'includes/check.func.php';
		$_clean = array();
		$_clean['touser'] = $_POST['touser'];
		$_clean['fromuser'] = $_COOKIE['username'];
		$_clean['content'] = _check_content($_POST['content']);
		$_clean = _mysql_string($_clean);
		print_r($_clean);
		// 写入表中
		_query("INSERT INTO tg_message(
					tg_touser,
					tg_fromuser,
					tg_content,
					tg_date
				) VALUES(
					'{$_clean['touser']}',
					'{$_clean['fromuser']}',
					'{$_clean['content']}',
					NOW()
				)");
		// 新增成功
		if(_affected_rows()==1){
			_close();
			_session_destroy();
			_alert_close("短信发送成功");
		}else{
			_close();
			_session_destroy();
			_alert_back("短信发送失败");
		}
	}else{
		_alert_close("唯一标识符异常，非法登录");
	}
}
// 获取数据
if(isset($_GET['id'])){
	// 因为是数据所以加花括号'{$_GET['id']}'
	if(!!$_rows = _fetch_array("SELECT tg_username FROM tg_user WHERE tg_id='{$_GET['id']}' LIMIT 1")){
		$_html = array();
		$_html['touser'] = $_rows['tg_username'];
		// 转义输出
		$_html = _html($_html);
	}else{
		_alert_close("不存在此用户");
	}
}else{
	_alert_close("非法操作n");
}



?>
<script type="text/javascript" src="js/code.js"></script>
<script type="text/javascript" src="js/message.js"></script>
<?php require ROOT_PATH.'includes/title.inc.php';?>
<title>写短信</title>

<div class="message"> 
	<h3>写短信</h3>
	<form method="post" action="message.php?action=write">
		<input type="hidden" name="touser" value="<?php echo $_html['touser'];?>"/>
		<dl>
			<dd>
				<input type="text" value="<?php echo $_html['touser'];?>" class="text"/></dd>
			<dd><textarea name="content"></textarea></dd>
			<dd>
				<label>验证码:</label>
				<input type="text" name="code" class="text yzm"/>
				<img src="code.php" class="code" id="code">
			</dd>
			<dd><input type="submit" class="submit" name=""/></dd>
		</dl>		
	</form>
</div>

