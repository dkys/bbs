<?php
$title = '回复帖子';
include_once 'skip.login.php';
if(!$memeber_id = is_login($link)){
    skip('请登录后再回复!','login.php');
    exit();
}
include_once 'header.inc.php';
if(!isset($_GET['contentid']) || !is_numeric($_GET['contentid'])){
    skip('参数不合法!','index.php');
    exit();
}
$link = new PDO('mysql:host=localhost;dbname=sansi_admin','root','123456');
$sql = "select * from sansi_content WHERE id={$_GET['contentid']}";
$rel = $link->query($sql);
foreach($rel as $contentrel){
}
if(empty($contentrel)){
    skip('您访问的页面不存在!','index.php');
    exit();
}
$sqlmm = "select * from sansi_members WHERE id={$contentrel['member_id']}";
$res = $link->query($sqlmm);
foreach($res as $memberrel){
}

if(isset($_POST['submit'])){
    if(strlen($_POST['recontent']) <= 3){
        skip('回复内容不得少于3个字!',$_SERVER['REQUEST_URI']);
        exit();
    }
    //------------------------------------------------addslashes()将提交的特殊字符转义,会自动插入\来转义--------------------------------------------------------------------

    $contenstr = addslashes($_POST['recontent']);


    $sqlinsert = "insert into sansi_reply(content_id,recontent,member_id) VALUES ({$_GET['contentid']},'{$contenstr}',{$memeber_id})";
    $rel = $link->exec($sqlinsert);
    if($rel > 0){
        skip('回复成功返回查看',"content_show.php?contentid={$_GET['contentid']}");
        exit();
    }else{
        skip('回复失败请返回重试!',$_SERVER['REQUEST_URI']);
        exit();
    }
}







?>
<div class="banner">
    <a href="index.php" class="yy">首页</a>&gt;<span>回复帖子</span>
</div>
<div class="content">
    <span style="margin: 10px;">回复来自: <?php echo nl2br(htmlspecialchars($memberrel['name']));  ?> 发布的 <?php echo nl2br(htmlspecialchars($contentrel['title'])); ?></span>
    <form method="post">
        <textarea name="recontent" style="margin: 0 auto;" id="" cols="126" rows="10" placeholder="请输入要回复的内容"></textarea>
        <input class="submit" name="submit" type="submit" value="回复">
    </form>
</div>



<?php include_once 'footer.inc.php'; ?>
