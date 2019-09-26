<?php
// 禁止非法调用
define("IN_TG",true);
// 在本页有效的CSS
define("SCRIPT","active");

// 引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';

//防止非法操作
if(!isset($_GET['active'])){
	_alert_back("非法操作");
}

// 邮件激活处理
if(isset($_GET['action'])&&isset($_GET['active']) && $_GET['action'] == 'ok'){
	// 转义一下
	$_active = _mysql_string($_GET['active']);
	if(_fetch_array("SELECT tg_active FROM tg_user WHERE tg_active='$_active' LIMIT 1")){
		// 如果数据库中存在就设置为空
		_query("UPDATE tg_user SET tg_active=NULL WHERE tg_active='$_active' LIMIT 1");
		if(_affected_rows() == 1){
			_close();
			_location("帐户激活成功","login.php");
		}else{
			_close();
			_location("帐户激活失败","register.php");
		}
	}else{
		_alert_back("非法操作");
	}
}
?>

<title>激活</title>
<meta charset="utf-8"/>
<?php require ROOT_PATH.'includes/title.inc.php';?>
<script type="text/javascript" src="js/register.js"></script>
<?php require ROOT_PATH."includes/header.inc.php";?>

<div class="active">
	<h2>激活帐户</h2>
	<p>模拟邮件功能，点击以下链接激活帐户</p>
	<p><a href="active.php?action=ok&amp;active=<?php echo $_GET['active'];?>"><?php echo 'http://'.$_SERVER["HTTP_HOST"].$_SERVER['PHP_SELF']?>active.php?action=ok&amp;active=<?php echo $_GET['active'];?></a></p>
</div>

<?php require ROOT_PATH."includes/footer.inc.php";?>