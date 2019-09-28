<?php
// 开启session
session_start();
// 禁止非法调用
define("IN_TG",true);
// 在本页有效的CSS
define("SCRIPT","member_modify");
// 引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';
// 修改资料
if($_GET['action']=='modify'){

}
// 是否正常登录
if(isset($_COOKIE['username'])){
    $_rows = _fetch_array("SELECT tg_username,tg_sex,tg_face,tg_email,tg_url,tg_qq FROM tg_user WHERE tg_username='{$_COOKIE['username']}'");
    if($_rows){
        $_html = array();
        $_html['username'] = $_rows["tg_username"];
        $_html['sex'] = $_rows['tg_sex'];
        $_html['face'] = $_rows['tg_face'];
        $_html['email'] = $_rows['tg_email'];
        $_html['url'] = $_rows['tg_url'];
        $_html['qq'] = $_rows['tg_qq'];
        $_html = _html($_html);

        // 姓别选择
        if($_html['sex']=='男'){
            $_html['sex_html'] = '<input type="radio" name="sex" value="男" checked="checked"/>男
                                  <input type="radio" name="sex" value="女"/>女';
        }elseif($_html['sex']=='女'){
            $_html['sex_html'] = '<input type="radio" name="sex" value="男" checked="checked"/>男
                                  <input type="radio" name="sex" checked="checked" value="女"/>女';
        }

        // 头像选择
        $_html['face_html']='<select name="face">';
        foreach(range(1,9) as $_num){
            $_html['face_html'] .= '<option value="face/m0'.$_num.'.gif">face/m0'.$_num.'.gif</option>';
        }
        foreach(range(10,64) as $_num){
            $_html['face_html'] .= '<option value="face/m'.$_num.'.gif">face/m'.$_num.'.gif</option>';
        }
        $_html['face_html'] .= '</select>';


    }else{
        _alert_back("此用户不存在");
    }
}else{
    _alert_back("非法登录");
}

?>

    <title>会员中心</title>
<?php require ROOT_PATH.'includes/title.inc.php';?>
     <script type="text/javascript" src="js/code.js"></script>
     <script type="text/javascript" src="js/member_modefy.js"></script>
<?php require ROOT_PATH."includes/header.inc.php";?>

    <div class="member">
        <?php require ROOT_PATH."includes/member.inc.php";?>
        <div class="member_main">
            <h2>会员管理中心</h2>
            <form action="member_modify.php?action=modify" method="post">
                <dl>
                    <dd>用户名：<?php echo $_html['username'];?></dd>
                    <dd>姓别：<?php echo $_html['sex_html'];?></dd>
                    <dd>头像：<?php echo $_html['face_html'];?></dd>
                    <dd>电子邮件：<input type="text" class='text' name="email" value="<?php echo $_html['email'];?>"></dd>
                    <dd>主页：<input type="text" class='text' name="url" value="<?php echo $_html['url'];?>"></dd>
                    <dd>QQ：<input type="text" class='text' name="qq" value="<?php echo $_html['qq'];?>"></dd>
                    <dd>
                        <label>验证码:</label>
                        <input type="text" name="code" class="text yzm"/>
                        <img src="code.php" class="code" id="code">
                    </dd>
                    <dd><input type="submit" value="修改资料" class="submit"></dd>
                </dl>
            </form>
        </div>
    </div>



<?php require ROOT_PATH."includes/footer.inc.php";?>