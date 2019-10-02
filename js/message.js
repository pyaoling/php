window.onload = function(){
	code();
	var fm = document.getElementsByTagName('form')[0];
	fm.onsubmit = function(){
		// 验证码验证
		if(fm.code.value.length !=4){
			alert("验证码必须4位");
			fm.code.value = '';
			fm.code.focus();
			return false;
		}
		// 内容验证
		if(fm.content.value.length < 10 || fm.content.value.length > 200){
			alert("短信内容不得小于10位或者最大不能为200位");
			fm.content.value='';
			fm.content.focus();
			return false;
		}
		return true;
	}
};