window.onload = function(){
	var all = document.getElementById("all");
	var form = document.getElementsByTagName("form")[0];
	all.onclick = function(){
		for(var i=0;i<form.elements.length;i++){
			if(form.elements[i].name!='chkall'){
				form.elements[i].checked = form.chkall.checked;
			}
		}
	}
	form.onsubmit=function(){
		if(confirm("你确定要批量删除短信吗？")){
			return true;
		}
	}
}