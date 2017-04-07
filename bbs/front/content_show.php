<?php
$title = '帖子内容';
include_once 'skip.login.php';
$memeber_id=is_login($link);
include_once 'header.inc.php';

if(!isset($_GET['contentid']) || !is_numeric($_GET['contentid'])){
    skip('贴子id不合法!','index.php');
    exit();
}
$link = new PDO('mysql:host=localhost;dbname=sansi_admin','root','123456');
$sql = "select * from sansi_content WHERE id={$_GET['contentid']}";
$res = $link->query($sql);

foreach($res as $content){
}
if(empty($content)){
    skip('您访问的帖子不存在!','index.php');
    exit();
}
$sqlupdate = "update sansi_content set times=times+1 WHERE id={$_GET['contentid']}";
$link->exec($sqlupdate);

$sqlmember = "select * FROM sansi_members WHERE id={$content['member_id']}";
$rel = $link->query($sqlmember);
foreach($rel as $member){
}

$sqlson = "select * from sansi_son_admin WHERE id={$content['son_id']}";
$relson = $link->query($sqlson);
foreach($relson as $sonrel){
}

$fathersql = "select * from sansi_user_admin WHERE id={$sonrel['father_id']}";
$relfather = $link->query($fathersql);
foreach($relfather as $fatherrel){
}


?>
<div class="banner">
    <a href="index.php" class="yy">首页</a>&gt;
    <a href="father_list.php?id=<?php echo $fatherrel['id']; ?>" class="tow"><?php echo $fatherrel['name'];?></a>&gt;
    <a href="son_list.php?id=<?php echo $content['son_id']; ?>"><?php echo $sonrel['son_name']; ?></a>&gt; <?php echo $content['title']; ?>
</div>
<!--------------------------------------------------上分页部分------------------------------------------------------------------------------->
<div class="pages1"  style="margin: 0 auto;width: 960px;height:30px;">
    <div class="page_list1">
        <?php
        include_once 'father.list.page.php';
        $sqlnunm = "select COUNT(*) from sansi_reply WHERE content_id={$_GET['contentid']}";
        $numrel = $link->query($sqlnunm);
        $num = $numrel->fetchColumn();
        $pagesize = 10;
        $date = pageList($num,$pagesize);
        echo $date['html'];
        if(!isset($_GET['page']) || !is_numeric($_GET['page']) || $_GET['page'] == '' || $_GET['page'] < 1){
            $_GET['page'] = 1;
        }
        $i = $num-($_GET['page']-1)*$pagesize;

        ?>
    </div>
    <a href="reply.php?contentid=<?php echo $_GET['contentid']; ?>" target="_blank" class="hf btnn"></a>
</div>

<div class="content">
    <?php
    if($_GET['page'] == 1){?>

        <!---------------------------------------------帖子内容部分--------------------------------------------------->
        <div>
            <div style="display: inline-block;width: 130px;margin:20px 0 0 20px; ">
                <a href="" style="float: left;width:130px;"><img style="padding:0;width:130px;height:130px;display: inline-block;margin: 0;" src="<?php if(!$member['photo'] == ''){echo $member['photo']; }else{echo './style/photo.jpg';} ?>"></a>
                <span style="clear:left;margin: 0 auto;display: block;"><?php echo $member['name']; ?></span>
            </div>

            <div style="display: inline-block;width: 780px;float:right;">
                <li style="margin:0 0 0 10px;border-bottom: dashed 1px #ddd;display: inline-block; width:750px;">
                    <h3 style="float:left;"><?php echo $content['title']; ?></h3>
                    <div class="div1">
                        <p class="p3">回复<span><?php echo $num; ?></span></p>
                        <p class="p4">阅读<span><?php echo $content['times']+1; ?></span></p>
                    </div>
                </li>
                <p class="div_down">楼主： <?php echo $member['name']; ?>    发布于：<?php echo $content['time']; ?></p>

            </div>
            <p style="float:right;"><?php echo htmlspecialchars($content['content']); ?></p>
        </div>

   <?php } ?>


    <!---------------------------------------------回帖部分--------------------------------------------------->
    <?php
    if($num>0){
    $resql = "select * from sansi_reply,sansi_members WHERE content_id={$_GET['contentid']} AND sansi_members.id=sansi_reply.member_id ORDER BY TIME DESC {$date['limit']}";
    $relre = $link->query($resql);
    $relre->setFetchMode(PDO::FETCH_ASSOC);

    foreach($relre as $re){
    ?>
    <hr/>
    <div>
        <div style="display: inline-block;width: 130px;margin:20px 0 0 20px; ">
            <a href="" style="float: left;width:130px;"><img style="padding:0;width:130px;height:130px;display: inline-block;margin: 0;" src="<?php if(!$re['photo'] == ''){echo $re['photo']; }else{echo './style/photo.jpg';} ?>"></a>
            <p style="display: inline-block;"><?php echo $re['name']; ?></p>
        </div>

        <div style="display: inline-block;width: 780px;float:right;">
        <li style="margin:0;display: inline-block; width:750px;">
            <p class="div_down" style="float:left; color:#666;">回复时间：<?php echo $re['time']; ?></p>
            <div class="div1" style="width: 80px;">
                <p class="p3" style="margin: 0; padding: 0;width: 30px;"><a href="quote.php?contentid=<?php echo $_GET['contentid']; ?>&replayid=<?php echo $re['re_id']; ?>" target="_blank" style="color:#666;">引用</a><span></span></p>
                <p class="p4" style="margin: 0; padding: 0;width: 40px;"><?php echo $i--; ?>楼<span></span></p>
            </div>
        </li>
            <p></p>
            <!---------------------------------------------------引用部分----------------------------------------------------------------->
        <li style="display: block;">
            <?php
            if(!$re['quote_id'] == 0){
                $sqlquo = "select * from sansi_reply WHERE re_id={$re['quote_id']}";
                $query1 = $link->query($sqlquo);
                foreach($query1 as $quo){
                }
                //获取引用的楼层数

                $renum = "select count(*) from sansi_reply WHERE content_id={$_GET['contentid']} AND re_id <= {$quo['re_id']}";
                $query = $link->query($renum);
                $numre = $query->fetchColumn();
                ?>
            <div style="width: 760px;background: #ddd;">
                <p style="padding: 5px;">引用<?php echo $numre; ?>楼 发表的: <?php echo nl2br(htmlspecialchars($quo['recontent'])); ?><br>
                    http://sansi.php.com
                </p>
            </div>
            <?php } ?>
            <!--
            *************************************************nl2br:在字符串的每个开始的新行输入<br>或者<br/>也就是格式保护***************************
            *******************************************htmlspecialchars:输出时过滤掉内容包含的html和php标记***************************************
            -->
            <?php echo nl2br(htmlspecialchars($re['recontent'])); ?>
        </li>
        </div>
    </div>
        <p></p>
<?php  }
    }else{
        exit();
     ?>
        <!-------------------------------------------------------------引用回复部分-------------------------------------------------------------------------->
                <!--
                *************************************************nl2br:在字符串的每个开始的新行输入<br>或者<br/>也就是格式保护***************************
                *******************************************htmlspecialchars:输出时过滤掉内容包含的html和php标记***************************************
                -->
                <?php echo nl2br(htmlspecialchars($re['recontent'])); ?>
            </li>
        </div>
    </div>
    <?php } ?>
<div class="bx_bottom1" style="clear:both;">
    <div class="page_list1" style="margin-bottom: 20px;">
    <?php echo $date['html']; ?>
    </div>
    <a href="reply.php?contentid=<?php echo nl2br(htmlspecialchars($_GET['contentid'])); ?>" target="_blank" class="hf btnn"></a>
</div>
<p></p>
<?php include_once 'footer.inc.php'; ?>
