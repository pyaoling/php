<?php
// 防止恶意调用
if(!defined('IN_TG')){
	exit("非法调用");
}
// 关闭数所库连接
mysql_close();
?>
<meta charset="utf-8">
<div class="footer">
	<p>版本所有 翻版必究&nbsp;备案号：湘</p>
	<p>本程序由低调的依恋提供</p>
	<p>程序耗时：<?php echo round((_runtime() - START_TIME),4);?>秒</p>
</div>