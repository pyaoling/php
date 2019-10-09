<?php
	header("Content-Tppe:text/html;charset=utf-8");
	if(!defined('IN_TG')){
		exit("非法调用");
	}
?>

<meta charset="utf-8">
<div class="header">
	<h1><a href="./index.php">低调的依恋</a></h1>
	<ul>
		<li><a href="index.php">首页</a></li>
		<?php
		if(isset($_COOKIE['username'])){
			echo "\n";
			echo '<li><a href="member.php">'.$_COOKIE['username'].'.个人中心</a>'.$_message_html.'</li>';
		}else{
			echo '<li><a href="register.php">注册</a></li>';
			echo "\n";
			echo '<li><a href="login.php">登录</a></li>';
		}
		?>
		<li><a href="blog.php">博友</a></li>
		<li><a href="javascript:void(0);">风格</a></li>
		<li><a href="javascript:void(0);">管理</a></li>
		<?php
			if(isset($_COOKIE['username'])){
				echo '<li><a href="logout.php">退出</a></li>';
			}
		?>
	</ul>	
</div>