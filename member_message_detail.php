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
// 删除短信模块
if(@$_GET['action']=='delete' && isset($_GET['id'])){
	// 去数据库验证存不存在
	$_rows = _fetch_array("SELECT 
				tg_id
			FROM
				tg_message
			WHERE 
				tg_id='{$_GET['id']}'
			LIMIT 1				

			");
	// 对唯一标识符验证
	$_rowss = _fetch_array("SELECT tg_uniqid FROM tg_user WHERE 
		tg_username='{$_COOKIE['username']}' LIMIT 1");
	if(!!$_rows){
		if(!!$_rowss){
			// 对比本地和数据库中的唯一标识符
			_uniqid($_rowss['tg_uniqid'],$_COOKIE['uniqid']);
			// 删除单条短信
			_query("DELETE FROM 
					tg_message 
				WHERE 
					tg_id='{$_GET['id']}' 
					LIMIT 1
					");
			if(_affected_rows()==1){
				_close();
				_session_destroy();
				_location("短信删除成功",'member_message.php');
			}else{
				_close();
				_session_destroy();
				_alert_back("短信删除失败");
			}
		}else{
			_alert_back("非法登录");
		}
		
	}else{
		_alert_back("此短信不存在，删除失败");
	}
	
	exit();
}
// 处理ID 短信
// 接收参数
if(isset($_GET['id'])){
	$_rows = _fetch_array("SELECT 
				tg_id,
				tg_state,
				tg_fromuser,
				tg_content,
				tg_date
			FROM 
				tg_message
			WHERE
				tg_id='{$_GET['id']}'
			LIMIT 1
		");
if($_rows){
	if(empty($_rows['tg_state'])){
		_query("UPDATE tg_message SET tg_state=1 WHERE tg_id='{$_GET['id']}' LIMIT 1");		
	}
	if(!_affected_rows()){
			_alert_back("异常");
	}
	$_html = array();
	$_html['id'] = $_rows['tg_id'];
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
<script src="js/member_message_detail.js"></script>
<div class="member">
	<?php require ROOT_PATH."includes/member.inc.php";?>
	<div class="member_main">
	    <h2>短信详情中心</h2>
	    <dl>
	    	<dd>发信人：<?php echo $_html['fromuser'];?></dd>
	    	<dd>内容：<?php echo $_html['content'];?></dd>
	    	<dd>发信息时间：<?php echo $_html['date'];?></dd>
	    	<dd>
	    		<input type="button" value="返回列表" id="return"/> 
	    	</dd>
	    	<dd>
	    		<input type="button" name="<?php echo $_html['id'];?>" value="删除短信" id="delete"/> 
	    	</dd>
	    </dl>	
	</div>    
</div>    

<?php require ROOT_PATH."includes/footer.inc.php";?>



