window.onload = function(){
	
	code();
	
	// 登录验证
	var fm = document.getElementsByTagName("form")[0];

	fm.onsubmit = function(){

		// 验证用户名
		if(fm.username.value.length < 2 || fm.username.value.length > 20){
			alert("用户名不得小于两位或者不能大于20位");
			fm.username.value = '';
			fm.username.focus();
			return false;
		}

		// 用户名非法字符过滤
		if(/[<>\'\"\ ]/.test(fm.username.value)){
			alert("用户名不得包含非法字符");
			fm.username.value = "";
			fm.username.focus();
			return false;
		}

		// 验证密码
		if(fm.password.value.length < 6){
			alert("密码不得小于6位");
			fm.password.value = "";
			fm.password.focus();
			return false;
		}

		// 验证码验证
		if(fm.code.value.length != 4){
			alert("验证码必须是4位");
			fm.code.value = '';
			fm.code.focus();
			return false;
		}

		return true;
	}


}