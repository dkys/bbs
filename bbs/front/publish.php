<?php
//var_dump($_POST);
//exit;
$title = '发帖页面';
$link = mysqli_connect('localhost','root','123456','sansi_admin');
include_once "skip.login.php";
if(!$memeber_id = is_login($link)){
    skip('请先登录!','login.php');
    exit();
}
//var_dump($memeber_id);
//exit;
include_once "header.inc.php";
if(isset($_POST['submit'])){
    if(empty($_POST['son_id'])){
    skip('请选择一个子版块!','publish.php');
        exit();
    }
    if(empty($_POST['title'])){
        skip('帖子标题不能为空!','publish.php');
        exit();
    }if(strlen($_POST['title'])>255){
        skip('帖子标题不能超过255个字符!','publish.php');
        exit();
    }
    if(empty($_POST['content'])){
        skip('帖子内容不能为空!','publish.php');
        exit();
    }
    $content = addslashes($_POST['content']);
    $titles = addslashes($_POST['title']);
    $sql3 = "insert into sansi_content(`son_id`, `title`, `content`, `time`, `member_id`) values({$_POST['son_id']},'{$titles}','{$content}',now(),{$memeber_id})";
    $query3 = mysqli_query($link,$sql3);
    if(mysqli_affected_rows($link) ==1){
        skip('发布成功! 返回继续发帖','index.php');
        exit();
    }else{
        skip('发布失败,请返回重试!','publish.php');
        exit();
    }
}
?>
<div class="banner">
    <a href="" class="yy">首页</a>&gt;<a href="" class="two">发帖专区</a>&gt;<a href="" class="three">php发帖区</a>
</div>
<div class="content">
    <form method="post">
    <select name="son_id" class="">
        <option class="op" value="0">========请选择一个版块========</option>
        <?php
        if(isset($_GET['fatherid']) && is_numeric($_GET['fatherid'])){
            $where = "where id={$_GET['fatherid']} ";
        }
        $sql1 = "select * from sansi_user_admin {$where}order by sort DESC";
        $query1 = mysqli_query($link,$sql1);
        while($date_father = mysqli_fetch_assoc($query1)){
                echo "<optgroup label='{$date_father['name']}'>";
            $sql = "select * from sansi_son_admin where father_id={$date_father['id']} order by sort DESC";
            $query = mysqli_query($link,$sql);
            while($date_son = mysqli_fetch_assoc($query)){
                if(isset($_GET['sonid']) && $_GET['sonid'] == $date_son['id']){
                    echo "<option selected='selected' class='op' name='son_id' value='{$date_son['id']}'>{$date_son['son_name']}</option>";
                }else{
                    echo "<option class='op' name='son_id' value='{$date_son['id']}'>{$date_son['son_name']}</option>";
                }
            }
                echo "</optgroup>";
        }
        ?>
    </select>
    <input type="text" class="input1" style="margin: 10px 0 10px 5px;width: 235px;" size="30" name="title" placeholder="请输入标题">
    <textarea name="content" style="margin: 0 auto;width: 940px;" cols="126" rows="10" placeholder="请输入帖子内容"></textarea>
    <input class="submit" name="submit" type="submit" value="发表">
    </form>
</div>
<?php include_once "footer.inc.php";?>
