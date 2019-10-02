window.onload = function(){

    var message = document.getElementsByName("message");
    for(var i = 0;i < message.length;i++){
        message[i].onclick = function(){
            centerWindow('message.php?id='+this.title,'message',250,400);
        }
    }
};

function centerWindow(url,name,height,width){
    // 总长度-减去本身的长度/2 =  垂直居中
    var left = (screen.width - width) / 2;
    // 水平方向同上
    var top = (screen.height - height) / 2;
    window.open(url,name,'height='+height+',width='+width+',top='+top+',left='+left+'');
}