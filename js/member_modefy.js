window.onload = function(){
    code();
    // 表单验证
    var fm = document.getElementsByTagName("form")[0];
    fm.onsubmit = function(){
        // 密码验证
        if(fm.password.value !=''){
            if(fm.password.value.length < 6){
                alert("密码不能小于6位");
                fm.password.value = '';
                fm.password.focus();
                return false;
            }
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
        if(fm.code.value.length !=''){
            if(fm.code.value.length !=4){
                alert("验证码必须4位");
                fm.code.value = '';
                fm.code.focus();
                return false;
            }
        }else{
            alert("验证码不能为空");
            fm.code.value='';
            fm.code.focus();
            return false;
        }
        return true;
    }
};