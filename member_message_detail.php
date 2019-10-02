<?php
session_start();
// 禁止非法调用
define("IN_TG",true);
// 在本页有效的CSS
define("SCRIPT","member_message_detail");
// 引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';
// 判断是否登录
if(!isset($_COOKIE['username'])){
	_alert_close("请先登录");
}
// 接收参数
if(isset($_GET['id'])){
	$_rows = _fetch_array("SELECT 
				tg_fromuser,tg_content,tg_date
			FROM 
				tg_message
			WHERE
				tg_id='{$_GET['id']}'
			LIMIT 1
		");
if($_rows){
	$_html = array();
	$_html['fromuser'] = $_rows['tg_fromuser'];
	$_html['content'] = $_rows['tg_content'];
	$_html['date'] = $_rows['tg_date'];
	$_html = _html($_html);
}else{
	_alert_back("此短信不存在");
}

}else{
	_alert_back("非法登录");
}

?>
<title>查看信息</title>
<?php require ROOT_PATH.'includes/title.inc.php';?>
          
<?php require ROOT_PATH."includes/header.inc.php";?>
<script src="js/member_message_detail.php"></script>
<div class="member">
	<?php require ROOT_PATH."includes/member.inc.php";?>
	<div class="member_main">
	    <h2>短信详情中心</h2>
	    <dl>
	    	<dd>发信人：<?php echo $_html['fromuser'];?></dd>
	    	<dd>内容：<?php echo $_html['content'];?></dd>
	    	<dd>发信息时间：<?php echo $_html['date'];?></dd>
	    	<dd>
	    		<input type="button" value="返回列表" onclick="javascript:history.back();"/> 
	    	</dd>
	    	<dd>
	    		<input type="button" value="删除短信" onclick="javascript:history.back();"/> 
	    	</dd>
	    </dl>	
	</div>    
</div>    

<?php require ROOT_PATH."includes/footer.inc.php";?>



