<?php
// 开启session
session_start();
// 禁止非法调用
define("IN_TG",true);
// 在本页有效的CSS
define("SCRIPT","member_message");
// 引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';
// 判断是否登录了
if(!isset($_COOKIE['username'])){
	_alert_back("请选登录");
}
// 分页模块
global $_pagesize,$_pagenum;
// 一页多少条
_page("SELECT tg_id FROM tg_message",10);
$_result=_query("SELECT 
	tg_id,
	tg_fromuser,
	tg_content,
	tg_date 
	FROM tg_message ORDER BY tg_date DESC LIMIT $_pagenum,$_pagesize");

?>

<title>查看信息</title>
<?php require ROOT_PATH.'includes/title.inc.php';?>
          
<?php require ROOT_PATH."includes/header.inc.php";?>

<div class="member">
	<?php require ROOT_PATH."includes/member.inc.php";?>
	<div class="member_main">
	    <h2>短信管理中心</h2>
	    <!-- cellspacing='1'  调小边框边距-->
	    <table cellspacing='1'>

	    	<tr><th>发信人</th><th>短信内容</th><th>时间</th><th>操作</th></tr>
	    	<?php while(!!$_rows = _fetch_array_list($_result)){
	    		$_html = array();
	    		$_html['id'] = $_rows['tg_id'];
	    		$_html['fromuser'] = $_rows['tg_fromuser'];
	    		$_html['content'] = $_rows['tg_content'];
	    		$_html['date'] = $_rows['tg_date'];
	    	?>
	    	<tr>
	    		<td><?php echo $_html['fromuser'];?></td>
	    		<td>
	    			<a href="member_message_detail.php?id=<?php echo $_html['id'];?>">
	    				<?php echo _title($_html['content']);?> 
	    			</a> 
	    		</td>
	    		<td><?php echo $_html['date'];?></td>
	    		<td><input type="checkbox" /></td> 
	    	</tr>
	    	<?php 
	    		}
	    	// 销毁磅大的结果集
	    	_free_result($_result);
	    	
	    	?>
	    </table>
	    <?php // 数字分页
	    	_pageing(1);
	    ?>
</div>    

<?php require ROOT_PATH."includes/footer.inc.php";?>