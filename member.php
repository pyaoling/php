<?php

// 禁止非法调用
define("IN_TG",true);
// 在本页有效的CSS
define("SCRIPT","member");
// 引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';
// 是否正常登录
if(isset($_COOKIE['username'])){
	$_rows = _fetch_array("SELECT tg_username,tg_sex,tg_face,tg_email,tg_url,tg_qq,tg_level,tg_reg_time FROM tg_user WHERE tg_username='{$_COOKIE['username']}'");
	if($_rows){
		$_html = array();
		$_html['username'] = $_rows["tg_username"];
		$_html['sex'] = $_rows['tg_sex'];
		$_html['face'] = $_rows['tg_face'];
		$_html['email'] = $_rows['tg_email'];
		$_html['url'] = $_rows['tg_url'];
		$_html['qq'] = $_rows['tg_qq'];
		$_html['reg_time'] = $_rows['tg_reg_time'];
		switch($_rows['tg_level']){
			case 0:
				$_html['level'] = "普通会员";
				break;
			case 1:
				$_html['level'] = "管理员";
		}
		$_html = _html($_html);
	}else{
		_alert_back("此用户不存在");
	}
}else{
	_alert_back("非法登录");
}

?>

<title>会员中心</title>
<?php require ROOT_PATH.'includes/title.inc.php';?>
<!-- <script type="text/javascript" src="js/register.js"></script> -->
<?php require ROOT_PATH."includes/header.inc.php";?>

<div class="member"> 
	<?php require ROOT_PATH."includes/member.inc.php";?>
	<div class="member_main"> 
		<h2>会员管理中心</h2>
		<dl>
			<dd>用户名：<?php echo $_html['username'];?></dd>
			<dd>姓别：<?php echo $_html['sex'];?></dd>			
			<dd>头像：<?php echo $_html['face'];?></dd>
			<dd>电子邮件：<?php echo $_html['email'];?></dd>
			<dd>主页：<?php echo $_html['url'];?></dd>
			<dd>QQ：<?php echo $_html['qq'];?></dd>
			<dd>注册时间：<?php echo $_html['reg_time'];?></dd>
			<dd>身份：<?php echo $_html['level'];?></dd>
		</dl>
	</div>
</div>



<?php require ROOT_PATH."includes/footer.inc.php";?>