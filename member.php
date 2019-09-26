<?php

// 禁止非法调用
define("IN_TG",true);
// 在本页有效的CSS
define("SCRIPT","member");
// 引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';


?>

<title>会员中心</title>
<?php require ROOT_PATH.'includes/title.inc.php';?>
<!-- <script type="text/javascript" src="js/register.js"></script> -->
<?php require ROOT_PATH."includes/header.inc.php";?>


<div class="member"> 
	<div class="member_sidebar"> 
		<h2>中心导航</h2>
		<dl>
			<dt>帐号管理</dt>
			<dd><a href="">个人信息</a></dd>
			<dd><a href="">修改资料</a></dd>
		</dl>		
		<dl>
			<dt>其它管理</dt>
			<dd><a href="">短信查阅</a></dd>
			<dd><a href="">好友设置</a></dd>
			<dd><a href="">查询花朵</a></dd>
			<dd><a href="">个人相册</a></dd>
		</dl>		
	</div>
	<div class="member_main"> 
		<h2>会员管理中心</h2>
	</div>
</div>



<?php require ROOT_PATH."includes/footer.inc.php";?>