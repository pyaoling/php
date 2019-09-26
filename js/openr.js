window.onload = function(){
	var img = document.getElementsByTagName("img");
	for(i=0;i<img.length;i++){
		img[i].onclick = function(){
			// 取src会是长链接：http://localhost/message/face/m04.gif
			// 取alt是短链接：face/m04.gif
			_opener(this.alt);
		}
	}
}

function _opener(src){
	// opener 表示父窗口(register.php)的文档
	var faceimg = opener.document.getElementById("faceimg");
	faceimg.src = src;
	// register 指表form标签中name的值
	// face 指页面中input中hidden标签中name的值
	opener.document.register.face.value = src;

	
}