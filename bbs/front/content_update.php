<?php
$title = '修改帖子';
include_once 'skip.login.php';
if(!$memeber_id = is_login($link)){
    skip('亲,您还没有登录哦!!','login.php');
    exit();
}
if(!isset($_GET['contentid']) || !is_numeric($_GET['contentid'])){
    skip('帖子ID不合法!','login.php');
    exit();
}
$link = new PDO('mysql:host=localhost;dbname=sansi_admin','root','123456');
$sql = "select * from sansi_content WHERE id={$_GET['contentid']}";
$rel = $link->query($sql);
$rel->setFetchMode(PDO::FETCH_ASSOC);


if($rel->rowCount() < 1){
    skip('您要修改的贴子不存在或者已经删除!','member.php');
    exit();
}
$content = $rel->fetch();
if($memeber_id != $content['member_id']){
    skip('亲,您没有修改权限哦!','member.php');
    exit();
}
include_once 'header.inc.php';

if(isset($_POST['submit'])){
    if(empty($_POST['title'])){
        skip('帖子标题不能为空!',$_SERVER['REQUEST_URI']);
        exit();
    }
    if(strlen($_POST['content']) <3){
        skip('帖子内容不得少于3个字!',$_SERVER['REQUEST_URI']);
        exit();
    }
    $titleadd = addslashes($_POST['title']);
    $contentadd = addslashes($_POST['content']);
    $updatesql = "update sansi_content set son_id={$_POST['son_id']},title='{$titleadd}',content='{$contentadd}',time=now() WHERE id={$_GET['contentid']}";

    if($link->exec($updatesql) > 0){
        skip('修改成功!',$_SERVER['REQUEST_URI']);
        exit();
    }else{
        skip('修改失败!',$_SERVER['REQUEST_URI']);
        exit();
    }

}

?>
<div class="content">
    <form method="post">
        <select name="son_id" class="">
            <option class="op" value="0">========请选择一个版块========</option>
            <?php
            $sql1 = "select * from sansi_user_admin order by sort DESC";
            $query1 = $link->query($sql1);
            foreach($query1 as $date_father) {
                echo "<optgroup label='{$date_father['name']}'>";
                $sql = "select * from sansi_son_admin where father_id={$date_father['id']} order by sort DESC";
                $query = $link->query($sql);
                foreach ($query as $date_son) {

                    if ($date_son['id'] == $content['son_id']) {
                        echo "<option selected='selected' class='op' name='son_id' value='{$date_son['id']}'>{$date_son['son_name']}</option>";
                    } else {
                        echo "<option class='op' name='son_id' value='{$date_son['id']}'>{$date_son['son_name']}</option>";
                    }
                    echo "</optgroup>";
                }
            }
            ?>
        </select>
        <input type="text" class="input1" value="<?php echo $content['title']; ?>" style="margin: 10px 0 10px 5px;width: 235px;" size="30" name="title" placeholder="请输入标题">
        <textarea name="content" style="margin: 0 auto;width: 940px;" cols="126"  rows="10" placeholder="请输入帖子内容"><?php echo $content['content']; ?></textarea>
        <input class="submit" name="submit" type="submit" value="发表">
    </form>
</div>


<?php include_once 'footer.inc.php'; ?>
