<!DOCTYPE html>
<html>
<head>
	<?php 
	header("content-type:text/html;charset=utf-8");
	// 禁止非法调用
	define("IN_TG",true);

	?>
	<title>选择头像</title>	
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="styles/1/face.css">
	<script type="text/javascript" src="js/openr.js"></script>
	
</head>
<body>
<div class="face">
	<h3>选择头像</h3>
	<dl>
		<?php foreach(range(1,9) as $number){?>
		<dd><img src="face/m0<?php echo $number;?>.gif" alt="face/m0<?php echo $number;?>.gif" title="头像<?php echo $number;?>"></dd>
		<?php }?>
		<?php foreach(range(10,64) as $number){?>
		<dd><img src="face/m<?php echo $number;?>.gif" alt="face/m<?php echo $number;?>.gif" title="头像<?php echo $number;?>"></dd>
		<?php }?>
	</dl>
</div>
</body>
</html>