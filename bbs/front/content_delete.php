<?php
$title = '删除帖子';
include_once 'skip.login.php';
if(!$memeber_id = is_login($link)){
    skip('亲,您还没有登录哦!','login.php');
    exit();
}
if(!isset($_GET['contentid']) || !is_numeric($_GET['contentid'])){
    skip('帖子ID不合法!',"member.php?memberid={$memeber_id}");
    exit();
}
$link = new PDO('mysql:host=localhost;dbname=sansi_admin','root','123456');
$sql = "select * from sansi_content WHERE id={$_GET['contentid']}";
$rel = $link->query($sql);

if($rel->rowCount() < 1){
    skip('您要删除的贴子不存在!',"member.php?memberid={$memeber_id}");
    exit();
}
foreach($rel as $contentrel){
    if($contentrel['member_id'] == $memeber_id){
        $sqldelete = "delete from sansi_content WHERE id={$_GET['contentid']}";
        if($link->exec($sqldelete) > 0){
            skip('删除成功!',"member.php?memberid={$memeber_id}");
            exit();
        }else{
            skip('删除失败!',"member.php?memberid={$memeber_id}");
            exit();
        }
    }else{
        skip('您没有操作权限!',"member.php?memberid={$memeber_id}");
        exit();
    }
}


include_once 'header.inc.php';
?>



<?php include_once 'footer.inc.php'; ?>
