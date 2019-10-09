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
// 批量删除短信
if(@$_GET['action']=='delete' && isset($_POST['ids'])){
	// 取到Id
	$_clean['ids'] = _mysql_string(implode(',',$_POST['ids']));
	// 防止COOKIE伪造，对比唯一标识符
	$_rows=_fetch_array("SELECT 
				tg_uniqid
			FROM
				tg_user
			WHERE 
				tg_username='{$_COOKIE['username']}'
			LIMIT 1
		");
	if(!!$_rows){
		_uniqid($_rows['tg_uniqid'],$_COOKIE['uniqid']);
		_query("DELETE FROM tg_message WHERE tg_id in ({$_clean['ids']})");
		if(_affected_rows() == 1){
			_close();
			_location("短信批量删除成功","member_message.php");
		}else{
			_close();
			_alert_back("短批量删除失败");
		}
		echo _affected_rows();
		exit();
	}else{
		_alert_back("非法登录");
	}
	exit();
}
// 分页模块
global $_pagesize,$_pagenum;
// 一页多少条
_page("SELECT tg_id FROM tg_message",10);
$_result=_query("SELECT 
	tg_id,
	tg_state,
	tg_fromuser,
	tg_content,
	tg_date 
	FROM tg_message ORDER BY tg_date DESC LIMIT $_pagenum,$_pagesize");

?>
<script type="text/javascript" src="js/member_message.js"></script>
<title>查看信息</title>
<?php require ROOT_PATH.'includes/title.inc.php';?>          
<?php require ROOT_PATH."includes/header.inc.php";?>

<div class="member">
	<?php require ROOT_PATH."includes/member.inc.php";?>
	<div class="member_main">
	    <h2>短信管理中心</h2>
	    <form method="post" action="member_message.php?action=delete">
	    <!-- cellspacing='1'  调小边框边距-->
	    <table cellspacing='1'>
	    	<tr><th>发信人</th><th>短信内容</th><th>时间</th><th>状态</th><th>操作</th></tr>
	    	<?php while(!!$_rows = _fetch_array_list($_result)){
	    		$_html = array();
	    		$_html['id'] = $_rows['tg_id'];
	    		$_html['state'] = $_rows['tg_state'];	    		
	    		$_html['fromuser'] = $_rows['tg_fromuser'];
	    		$_html['content'] = $_rows['tg_content'];
	    		$_html['date'] = $_rows['tg_date'];
	    		$_html = _html($_html);
	    		if(empty($_rows['tg_state'])){
	    			$_html['state'] = '未读';
	    			$_html['content_html'] = '<strong>'._title($_html['content']).'</strong>';
	    		}else{
	    			$_html['state'] = '已读';
	    			$_html['content_html'] = _title($_html['content']);
	    		}
	    	?>
	    	<tr>
	    		<td><?php echo $_html['fromuser'];?></td>
	    		<td>
	    			<a href="member_message_detail.php?id=<?php echo $_html['id'];?>">
	    				<?php echo $_html['content_html'];?> 
	    			</a> 
	    		</td>
	    		<td><?php echo $_html['date'];?></td>
	    		<td><?php echo $_html['state'];?></td>
	    		<td><input type="checkbox" name='ids[]' value='<?php echo $_html['id'];?>'/></td> 
	    	</tr>
	    	<?php 
	    		}
	    	// 销毁磅大的结果集
	    	_free_result($_result);
	    	
	    	?>
	    	<tr> 
	    		<td colspan='5'>
	    			<label for='all'>全选<input type="checkbox" name="chkall" id="all"/></label>
	    			<input type="submit" value='批量删除'>
	    		</td>
	    	</tr>
	    </table>
	    </form>
	    <?php // 数字分页
	    	_pageing(2);
	    ?>
</div>    

<?php require ROOT_PATH."includes/footer.inc.php";?>