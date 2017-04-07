<?php
$title = '子版块列表页';
include_once "skip.login.php";
$memeber_id=is_login($link);
if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
skip('id参数不合法!','index.php');
    exit();
}
include_once 'header.inc.php';


$link = new PDO('mysql:host=localhost;dbname=sansi_admin','root','123456');

$sql = "SELECT * FROM sansi_son_admin WHERE id={$_GET['id']}";

$rel = $link->query($sql);
if(empty($rel)){
    skip('!','index.php');
}
$date_son = '';
foreach($rel as $date_son){
//var_dump($value);
}

$sqlfather = "SELECT * FROM sansi_user_admin WHERE id={$date_son['father_id']}";
$rel = $link->query($sqlfather);
$date_father='';
foreach($rel as $date_father){

}

//帖子总数量
$sqlcontent = "SELECT COUNT(*) FROM sansi_content WHERE son_id={$_GET['id']}";
$res = $link->query($sqlcontent);
$all_count = $res->fetchColumn();

// 今日发帖数量
$sqltady = "SELECT COUNT(*) FROM sansi_content WHERE son_id ={$_GET['id']} AND time>CURRENT_DATE ";
$reldaty = $link->query($sqltady);
$tady_count = $reldaty->fetchColumn();


?>
<div class="banner">
    <a href="index.php" class="yy">首页</a>&gt;<a href="father_list.php?id=<?php echo $date_father['id'] ?>" class="tow"><?php echo $date_father['name'] ?></a>&gt;<?php echo $date_son['son_name'] ?>
</div>
<div class="box_content">
    <div class="content1">
        <h3><?php echo $date_son['son_name'] ?></h3>
        <div class="bx">
            今日:
            <span><?php echo $tady_count ?></span>
            总贴:
            <span><?php echo $all_count ?></span>
        </div>
        <div class="pa">版主:
            <?php echo '暂无版主'; ?>
        </div>
        <!---------------------------------------------------------------------------------上边分页部分------------------------------------------------------------------------------------------------------------------------>
        <div class="pages">
            <a href="publish.php?sonid=<?php echo $_GET['id']; ?>" target="_blank" class="publish btns"></a>
            <div class="page_list">
                <?php
                include_once 'father.list.page.php';
                $date = pageList($all_count,3);
                echo $date['html'];
                ?>
            </div>
        </div>
        <!------------------------------------------------------------------------标题列表主体部分-------------------------------------------------------------------------------------------------------------------->
        <?php
        $content_sql = "select sansi_content.title,sansi_content.id,sansi_content.time,sansi_content.times,sansi_members.name,sansi_members.photo from
sansi_content,sansi_members where
sansi_content.son_id={$_GET['id']} AND
sansi_content.member_id=sansi_members.id {$date['limit']}";
        $content_query = $link->query($content_sql);
        foreach($content_query as $date_content){



        //获取当前页的回帖数量
        $sqlnunm = "select COUNT(*) from sansi_reply WHERE content_id={$date_content['id']}";
        $numrel = $link->query($sqlnunm);
        $num = $numrel->fetchColumn();
        ?>

        <ul class="content_list">
            <li>
                <a href=""><img src="<?php if(!$date_content['photo'] == ''){echo $date_content['photo']; }else{echo './style/photo.jpg';} ?>"></a>
                <a href="content_show.php?contentid=<?php echo $date_content['id']; ?>" target="_blank" class="a2"><?php echo $date_content['title']; ?></a>
                <p class="p1">回复<span><?php echo $num; ?></span></p>
                <p class="p2">浏览<span><?php echo $date_content['times']; ?></span></p>
                <p class="div_down">楼主：<?php echo $date_content['name'] ?> <?php echo $date_content['time'] ?>    最后回复：<?php
                    $sqlretime = "select MAX(time) from sansi_reply WHERE content_id={$date_content['id']}";
                    $querytime = $link->query($sqlretime);
                    foreach($querytime as $lastretime){
                        if($lastretime['MAX(time)'] != ''){
                            echo $lastretime['MAX(time)'];
                        }else{
                            echo '暂无回复!';
                        }

                    } ?></p>
            </li>

            <?php  } ?>

            <div class="bx_bottom">
                <a href="publish.php" target="_blank" class="publish btns"></a>
                <div class="page_list">
                    <?php echo $date['html']; ?>
                </div>
            </div>
    </div>
    <!----------------------------------------------------------右侧列表栏--------------------------------------------------------------------------------------------------------------->
    <div class="right_list">
        <h5>板块列表</h5>
        <?php
        $father_list_sql = "select * from sansi_user_admin";
        $father_list_query = $link->query($father_list_sql);
        foreach($father_list_query as $father_list_date){?>
            <ul>
                <h2><a href="father_list.php?id=<?php echo $father_list_date['id'] ?>"><?php echo $father_list_date['name'];?></a></h2>
                <?php
                $son_list_sql = "select * from sansi_son_admin where father_id={$father_list_date['id']}";
                $son_list_query = $link->query($son_list_sql);
                foreach($son_list_query as $son_list_date){?>
                    <li><a href="son_list.php?id=<?php echo $son_list_date['id'];?>"><?php echo $son_list_date['son_name'];?></a></li>
                <?php } ?>
            </ul>
        <?php } ?>
    </div>
</div>
<?php include_once 'footer.inc.php'; ?>
