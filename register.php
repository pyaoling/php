<?php
header("content-type:text/html;charset=utf-8");
// 开启session
session_start();
// 禁止非法调用
define("IN_TG",true);
// 在本页有效的CSS
define("SCRIPT","register");
// 引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';

require ROOT_PATH.'includes/title.inc.php';
// 如果为登录状态不可能进行本页面
_login_state();
if(@$_GET['action']=='register'){
	// 为了防止恶意注册，跨站攻击
	_check_code($_POST['code'],$_SESSION['code']);	
	include ROOT_PATH.'includes/check.func.php';
	// 接收用户username,$_POST[username]是污染数据，就是外部不可信的数据，就是没有过滤的数据
	// 创建一个空数组，用来存储提交过来的合法数据
	// 引入验证文件
	$_clean = array();
	// 可以通过唯一标识符来防止恶意注册，伪装表单跨站攻击
	// 存放到数据库的唯一标识符还有第二个用处，就是登录cookie验证，证明没有伪造cookie登录
	$_clean['uniqid'] = _check_uniqid($_POST['uniqid'],$_SESSION['uniqid']);
	//active也量个唯一标识符， 用于激活新用户激活处理才可以注册
	$_clean['active']= _sha1_uniqid();
	$_clean['username'] = _check_username($_POST['username'],2,20);
	$_clean['password'] = _check_password($_POST['password'],$_POST['notpassword'],6);
	$_clean['question'] = _check_question($_POST['question'],4,20);
	$_clean['answer'] = _check_answer($_POST['question'],$_POST['answer'],2,20);
	// 值是死的不需要验证
	$_clean['sex'] = _check_sex($_POST['sex']);
	// 值是死的不需要验证
	$_clean['face'] = _check_face($_POST['face']);
	$_clean['email'] = _check_email($_POST['email'],6,40);
	$_clean['qq'] = _check_qq($_POST['qq']);
	$_clean['url'] = _check_url($_POST['url'],40);
	// 新增之前，要判断用户名是否重复
	// $query = _query("SELECT tg_username FROM tg_user WHERE tg_username='{$_clean['username']}'");	
	// // MYSQL_ASSOC以字段为下标
	// if(mysql_fetch_array($query,MYSQL_ASSOC)){
	// 	_alert_back("用户名被注册");
	// }

	// if(_fetch_array("SELECT tg_username FROM tg_user WHERE tg_username='{$_clean['username']}'")){
	// 	_alert_back("用户名已被注册");		
	// }

	_is_repeat(
		"SELECT tg_username FROM tg_user WHERE tg_username='{$_clean['username']}' LIMIT 1",
		"用户名已被注册"
	);


	// 新增用户
	_query("INSERT INTO tg_user(
		tg_uniqid,
		tg_active,
		tg_username,
		tg_password,
		tg_question,
		tg_answer,
		tg_sex,
		tg_face,
		tg_email,
		tg_qq,
		tg_url,
		tg_reg_time,
		tg_last_time,
		tg_last_ip
	) VALUE(
		'{$_clean['uniqid']}',
		'{$_clean['active']}',		
		'{$_clean['username']}',
		'{$_clean['password']}',
		'{$_clean['question']}',
		'{$_clean['answer']}',
		'{$_clean['sex']}',
		'{$_clean['face']}',
		'{$_clean['email']}',
		'{$_clean['qq']}',
		'{$_clean['url']}',
		NOW(),
		NOW(),
		'{$_SERVER['REMOTE_ADDR']}'
)") or die("SQL执行失败".mysql_error());
	if(_affected_rows()==1){
		// 关闭
		_close();
		// 清空SESSION给服务器腾出内存
		_session_destroy();
		_location(_affected_rows()."恭喜您注册成功","active.php?active=".$_clean['active']);

	}else{
		// 关闭
		_close();
		_session_destroy();
		_location("很遗叹！注册失败","register.php");
	}
	
}else{
	// 在服务器端保存这个维一标识符
	$_SESSION['uniqid'] = $_uniqid = _sha1_uniqid();
}

?>
<title>注册页</title>
<meta charset="utf-8"/>
<script type="text/javascript" src="js/code.js"></script>
<script type="text/javascript" src="js/register.js"></script>
<?php require ROOT_PATH."includes/header.inc.php";?>
<div class="register">
	<h2>会员注册</h2>
	<form method="post" action="register.php?action=register" name="register">		
		<input type="hidden" name="uniqid" value="<?php echo $_uniqid;?>">
		<dl>
			<dt>请认真填写以下内容</dt>
			<dd><label>用户名:</label><input type="text" name="username" class="text"/>&nbsp;(*必填，至少两位)</dd>
			<dd><label>密码:</label><input type="password" name="password" class="text"/>&nbsp;(*必填，至少六位)</dd>
			<dd><label>确认密码:</label><input type="password" name="notpassword" class="text"/>&nbsp;(*必填，同上)</dd>
			<dd><label>密码提示:</label><input type="text" name="question" class="text"/>&nbsp;(*必填，至少两位)</dd>
			<dd><label>密码回答:</label><input type="text" name="answer" class="text"/>&nbsp;(*必填，至少两位)</dd>
			<dd><label>性别:</label>
				<input type="radio" name="sex" value="男" checked="checked" class=""/>男
				<input type="radio" name="sex" value="女" class=""/>女
			</dd>
			<dd class="face">
				<input type="hidden" name="face" value="">
				<img src="face/m01.gif" id="faceimg">
			</dd>
			<dd>
				<label>电子邮件:</label><input type="text" name="email" class="text"/>(*必填，用于激活帐户)</dd>
			<dd><label>QQ:</label><input type="text" name="qq" class="text"/></dd>
			<dd><label>主页地址:</label><input type="text" name="url" value="http://" class="text"/></dd>
			<dd>
				<label>验证码:</label>
				<input type="text" name="code" class="text yzm"/>
				<img src="code.php" class="code" id="code">
			</dd>
			<dd><input type="submit" name="submit" value="注册" class="submit"></dd>
		</dl>
	</form>
</div>
<?php require ROOT_PATH."includes/footer.inc.php";?>
