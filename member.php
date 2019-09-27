<?php

// 禁止非法调用
define("IN_TG",true);
// 在本页有效的CSS
define("SCRIPT","member");
// 引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';
// 是否正常登录

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
			<dd>用户名：瓶子小</dd>
			<dd>密码：123456</dd>
			<dd>头像：face/01.gif</dd>
			<dd>电子邮件：243579780@qq.com</dd>
			<dd>主页：www.hao9669.com</dd>
			<dd>QQ：243579780</dd>
			<dd>注册时间：2019-09-22 10：10：10</dd>
			<dd>身份：超级管理员</dd>
		</dl>
	</div>
</div>



<?php require ROOT_PATH."includes/footer.inc.php";?>