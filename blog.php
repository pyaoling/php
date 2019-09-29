<?php
// 禁止非法调用
define("IN_TG",true);
// 在本页有效的CSS
define("SCRIPT","blog");
// 引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';
// 分页模块
_page("SELECT tg_id FROM tg_user",15);
// 提取数据
// FROM tg_user ORDER BY tg_reg_time DESC  最新注册的会在最前面
$_result=_query("SELECT tg_id,tg_username,tg_sex,tg_face FROM tg_user ORDER BY tg_reg_time DESC LIMIT $_pagenum,$_pagesize");
// 必须是每次重新去读取结果集，而不是重新去执行SQL语句
?>
<title>博友</title>
<script type="text/javascript" src="js/blog.js"></script>
<?php require ROOT_PATH.'includes/title.inc.php';?>
<!-- <script type="text/javascript" src="js/register.js"></script> -->
<?php require ROOT_PATH."includes/header.inc.php";?>
<div class="blog">
	<h2>博友</h2>
	<?php 
		// MYSQL_ASSSOC 数组下标强行为字符串
		while(!!$_rows=_fetch_array_list($_result)){ 
			$_html = array();
			$_html['id'] = $_rows['tg_id'];
			$_html['username'] = $_rows['tg_username'];
			$_html['face'] = $_rows['tg_face'];
			$_html['sex'] = $_rows['tg_sex'];
			$_html = _html($_html);
		?>
	<dl>
		<dd class='user'><?php echo $_html['username'];?>(<?php echo $_html['sex'];?>)</dd>
		<dt><img src="<?php echo $_html['face'];?>" alt='111'></dt>
		<dd class="message"><a href="javascript:void(0);" name="message" title="<?php echo $_html['id'];?>">发消息</a></dd>
		<dd class="friend">加为好友</dd>
		<dd class="guest">写留言</dd>
		<dd class="flower">送花</dd>
	</dl>
	<?php }
	// 销毁结果集
	_free_result($_result);
	// 数字分页
	_pageing(1);
	// 文本分页
	_pageing(2);
	?>
</div>
<?php require ROOT_PATH."includes/footer.inc.php";?>
