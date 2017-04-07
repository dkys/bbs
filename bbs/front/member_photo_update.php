<?php
$title = '修改头像';
include_once 'skip.login.php';

if(!$memeber_id=is_login($link)){
    skip('亲,您还没有登录哦!还不能设置头像哦!','index.php');
    exit();
}

include_once 'photo_upload.inc.php';
$link = new PDO('mysql:host=localhost;dbname=sansi_admin','root','123456');
if(isset($_POST['submit'])){
    $save_path = 'photo/'.date('Y/m/d');
$arr = upload($save_path,'3m','photo');
    if($arr['return']){
        $sql = "update sansi_members set photo='{$arr['save_path']}' WHERE id={$memeber_id}";
        $query = $link->exec($sql);
        if($query == 1){
            skip('头像设置成功!',"member.php?memberid={$memeber_id}");
            exit();
        }else{
            skip('头像设置失败,请重试!','member_photo_update.php');
            exit();
        }
    }else{
        skip($arr['error'],'member_photo_update.php');
        exit();
    }
}
$sql1 = "select photo from sansi_members WHERE id={$memeber_id}";
$query1 = $link->query($sql1);
$url = $query1->fetch(PDO::FETCH_ASSOC);
//echo $url['photo'];
$server_path = dirname(__FILE__);
$path = str_replace('\\','/',$server_path);
$windows_root_path = str_replace($_SERVER['DOCUMENT_ROOT'],'',$path);
$photo_url = $windows_root_path.'/'.$url['photo'];

include_once 'header.inc.php';


?>

<div class="div1" style="width: 1520px;margin: 10px auto;">
<h1>修改头像</h1>

    <p>原头像</p>
    <img style="width: 180px;" src="<?php if(!$url['photo'] == ''){echo $photo_url; }else{echo './style/photo.jpg';} ?>" alt="">
    <br/>
    最佳图片尺寸:180x180
    <form action="" method="post" enctype="multipart/form-data">
        <input class="input1" type="file" name="photo" value="123" style="margin: 10px 0;"><br/>
        <input class="input2" type="submit" value="保 存" name="submit" style="background: #1b75b6;border: 0;width: 70px;height: 30px;border-radius: 3px;color:#fff;">
    </form>
</div>
<div>

<?php //include_once 'footer.inc.php'; ?>