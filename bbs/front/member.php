<?php
$title = '会员中心';
include_once 'skip.login.php';
$memeber_id=is_login($link);
    if(!isset($_GET['memberid']) || !is_numeric($_GET['memberid'])){
        skip('会员ID不合法!','login.php');
        exit();
    }

$link = new PDO('mysql:host=localhost;dbname=sansi_admin','root','123456');
    $sql = "select * from sansi_members WHERE id={$_GET['memberid']}";
    $rel = $link->query($sql);

//rowCount() 返回执行sql语句后受影响的行数  比如:update select delete insert
if($rel->rowCount() <1){
    skip('该会员不存在!','login.php');
    exit();
}
    foreach($rel as $memberrel){
    }
include_once 'header.inc.php';

//帖子总数量
$sqlcontent = "SELECT COUNT(*) FROM sansi_content WHERE member_id={$_GET['memberid']}";
$res = $link->query($sqlcontent);
$all_count = $res->fetchColumn();




?>
<div class="banner">
    <a href="index.php" class="yy">首页</a>&gt;<a class="tow">会员中心</a>
</div>
<div class="box_content">
    <div class="content1">

        <!---------------------------------------------------------------------------------上边分页部分------------------------------------------------------------------------------------------------------------------------>
        <div class="pages">
            <a href="publish.php" target="_blank" class="publish btns"></a>
            <div class="page_list">
                <?php
                include_once 'father.list.page.php';
                $date = pageList($all_count,10,5);
                echo $date['html'];
                ?>
            </div>
        </div>
        <!------------------------------------------------------------------------标题列表主体部分-------------------------------------------------------------------------------------------------------------------->
        <?php
        $content_sql = "select * from sansi_content WHERE member_id={$_GET['memberid']} ORDER BY time DESC {$date['limit']}";
        $content_query = $link->query($content_sql);
        foreach($content_query as $date_content){



        //获取当前页的回帖数量
        $sqlnunm = "select COUNT(*) from sansi_reply WHERE content_id={$_GET['memberid']}";
        $numrel = $link->query($sqlnunm);
        $num = $numrel->fetchColumn();
        ?>

        <ul class="content_list">
            <li>
                <a href="member.php?memberid=<?php echo $_GET['memberid']; ?>"><img style="width: 45px;" src="<?php if(!$memberrel['photo'] == ''){echo $memberrel['photo']; }else{echo './style/photo.jpg';} ?>"></a>
                <a href="content_show.php?contentid=<?php echo $date_content['id']; ?>" target="_blank" class="a2"><?php echo $date_content['title']; ?></a>
                <p class="p1">回复<span><?php echo $num; ?></span></p>
                <p class="p2">浏览<span><?php echo $date_content['times']; ?></span></p>
                <p class="div_down">发帖日期: <?php echo $date_content['time']?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;最后回复：<?php
                    $sqlretime = "select MAX(time) from sansi_reply WHERE content_id={$date_content['id']}";
                    $querytime = $link->query($sqlretime);
                    foreach($querytime as $lastretime){
                        if($lastretime['MAX(time)'] != ''){
                            echo $lastretime['MAX(time)'];
                        }else{
                            echo '暂无回复!';
                        }

                    } ?></p>
                <?php
                $reurl = urlencode($_SERVER['REQUEST_URI']);
//                echo $reurl;
                $deleteurl = urlencode('content_delete.php'.'&contentid='.$date_content['id']);
//                echo $deleteurl;exit();
                ?>
                <span class="div_down" style="margin-left: 60px;"><a href="content_update.php?contentid=<?php echo $date_content['id']; ?>" target="_blank">编辑</a>|<a href="tiaozhuan.php?name=<?php echo $date_content['title']; ?>&reurl=<?php echo $reurl; ?>&deleteurl=<?php echo $deleteurl; ?>">删除</a></span>
            </li>

            <?php } ?>

            <div class="bx_bottom">
                <a href="publish.php" target="_blank" class="publish btns"></a>
                <div class="page_list">
                    <?php echo $date['html']; ?>
                </div>
            </div>
    </div>
    <!----------------------------------------------------------右侧列表栏--------------------------------------------------------------------------------------------------------------->
    <?php
    $sqlcontentnum = "select count(*) from sansi_content WHERE member_id={$_GET['memberid']}";
    $querynum = $link->query($sqlcontentnum);
    $contentnum = $querynum->fetchColumn();


    ?>
    <div class="right_list">
        <a href="member_photo_update.php"><img  src="<?php if(!$memberrel['photo'] == ''){echo $memberrel['photo']; }else{echo './style/photo.jpg';} ?>" style="margin: 0 0 0 30px;width: 180px;" alt=""></a>
        <span style="text-align: center;width: 280px; margin: 0 auto;"><?php echo $memberrel['name']; ?></span>
        <span style="text-align: center;width: 280px; margin: 0 auto;">发帖总数:<?php echo $contentnum; ?></span>
    </div>
</div>
<?php include_once 'footer.inc.php'; ?>
