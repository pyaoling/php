window.onload = function(){

	code();

	var faceimg = document.getElementById("faceimg");
	faceimg.onclick = function(){
		window.open('face.php','face','width=400,height=400,top=150,left=250')	
	};
	

	// 表单验证
	var fm = document.getElementsByTagName('form')[0];
	fm.onsubmit = function(){
		// 用户名验证
		if(fm.username.value.length < 2 || fm.username.value.length > 20){
			alert("用户名不得小于2位或者大于20位");
			fm.username.value = '';
			fm.username.focus();
			return false;
		}
		if(/[<>\'\"\ ]/.test(fm.username.value)){
			alert("用户名不得包含非法字符,如：单引号、双引号 空格 尖括号");
			fm.username.value = '';
			fm.username.focus();
			return false;
		}
		// 密码验证
		if(fm.password.value.length < 6){
			alert("密码不能小于6位");
			fm.password.value = '';
			fm.password.focus();
			return false;
		}
		if(fm.password.value != fm.notpassword.value){
			alert("客户端提醒：密码和密码确认必须一致");
			fm.password.value = '';
			fm.password.focus();
			fm.notpassword.value='';
			fm.notpassword.focus();
			return false;
		}
		// 密码提示
		if(fm.question.value.length<2||fm.question.value.length>20){
			alert("密码提示不得小于2位，不能大于20位");
			fm.question.value = '';
			fm.question.focus();
			return false;
		}
		// 密码回答
		if(fm.answer.value.length < 2 || fm.answer.value.length > 20){
			alert("密码回答不得小于2位，不得大于20位");
			fm.answer.value = '';
			fm.answer.focus();
			return false;
		}
		if(fm.answer.value == fm.question.value){
			alert("密码回答与密码提示不得一致");
			fm.answer.value = '';
			fm.answer.focus();
			return false;
		}

		// 邮箱验证
		if(fm.email.value!=""){
			if(!/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/.test(fm.email.value)){
				alert("邮件格式不正确");
				fm.email.value='';
				fm.email.focus();
				return false;
			}
		}else{
			alert("邮箱为必填项");
			fm.email.vlaue="";
			fm.email.focus();
			return false;
		}
		

		// QQ号码验证
		if(fm.qq.value != ""){
			if(!/^[1-9]{1}[\d]{4,10}$/.test(fm.qq.value)){
				alert("qq号码不正确");
				fm.qq.value = '';
				fm.qq.focus();
				return false;
			}
		}

		// 网址验证
		if(fm.url.value != ""){
			if(!/^https?;\/\/(\w+\.)?[\w\-\.]+(\.\w+)+$/){
				alert("网址不合法");
				fm.url.value ="";
				fm.url.focus();
				return false;
			}
		}

		// 验证码验证
		if(fm.code.value.length !=4){
			alert("验证码必须4位");
			fm.code.value = '';
			fm.code.focus();
			return false;
		}
		return true;
	}
	
}

