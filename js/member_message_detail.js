window.onload = function(){

    var bk = document.getElementById("return");
    bk.onclick = function(){
        history.back();    
    }

    var del = document.getElementById("delete");
    del.onclick = function(){
        if(confirm('确认要删除此条信息？')){
            location.href='member_message_detail.php?action=delete&id='+this.name;
        }
    }
}