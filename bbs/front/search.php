<?php
$title = '搜索结果';
include_once 'skip.login.php';
$memeber_id=is_login($link);
include_once 'header.inc.php';
$link1 = mysqli_connect('localhost','root','123456','sansi_admin');
$_GET['keywords']=trim($_GET['keywords']);
$cont_sql = "select * from sansi_content WHERE title like '%{$_GET['keywords']}%'";
$query = mysqli_query($link1,$cont_sql);
$all_count = mysqli_num_rows($query);

?>
<div class="banner">
    <a href="index.php" class="yy">首页</a>&gt;<a href="father_list.php?id=<?php //echo $date_father['id'] ?>" class="tow"><?php //echo $date_father['name'] ?></a>&gt;<?php //echo $date_son['son_name'] ?>
</div>
<div class="box_content">
    <div class="content1">
        <div class="pa">搜索结果共:
            <?php echo $all_count; ?>条
        </div>
        <div class="pages">
            <div class="page_list">
                <?php
                include_once 'father.list.page.php';
                $date = pageList($all_count,5);
                echo $date['html'];
                ?>
            </div>
        </div>

        <?php
        $link = new PDO('mysql:host=localhost;dbname=sansi_admin','root','123456');
        $sql = "select sansi_content.title,sansi_content.id,sansi_content.time,sansi_content.times,sansi_son_admin.son_name,sansi_members.name,sansi_members.photo from sansi_content,sansi_son_admin,sansi_members WHERE title like '%{$_GET['keywords']}%' AND
sansi_content.son_id=sansi_son_admin.id AND
sansi_content.member_id=sansi_members.id {$date['limit']}";
        $query = $link->query($sql);
        foreach($query as $date_content){
            $titles = addslashes($date_content['title']);//给字符串添加反斜线,即转义字符串
            $titles=str_replace($_GET['keywords'],"<a style='color:red;'>{$_GET['keywords']}<a>",$titles);//将关键词替换显示红色
            //获取当前页的回帖数量
            $sqlnunm = "select COUNT(*) from sansi_reply WHERE content_id={$date_content['id']}";
            $numrel = $link->query($sqlnunm);
            $num = $numrel->fetchColumn();




            ?>


            <!----------------------------------------------------父板块帖子列表部分----------------------------------------------------------------------->
            <ul class="content_list">
                <li>
                    <a href=""><img height="45px;" src="<?php if(!$date_content['photo'] == ''){echo $date_content['photo']; }else{echo './style/photo.jpg';} ?>"></a>
                    <a href="" class="a1">[<?php echo $date_content['son_name']; ?>]</a><a href="content_show.php?contentid=<?php echo $date_content['id']; ?>" target="_blank" class="a2"><?php echo $titles; ?></a>
                    <p class="p1">回复<span><?php echo $num[0]; ?></span></p>
                    <p class="p2">浏览<span><?php echo $date_content['times']; ?></span></p>
                    <p class="div_down">楼主：<?php echo $date_content['name'] ?> <?php echo $date_content['time'] ?>    最后回复：<?php

                        //获取当前帖子回复的最后回复的时间
                        $sqlretime = "select MAX(time) from sansi_reply WHERE content_id={$date_content['id']}";
                        $querytime = $link->query($sqlretime);
                        foreach($querytime as $lastretime) {
                            if ($lastretime['MAX(time)'] != '') {
                                echo $lastretime['MAX(time)'];
                            } else {
                                echo '暂无回复!';
                            }
                        }
                        ?></p>
                </li>
            </ul>

        <?php  } ?>

        <div class="bx_bottom">
            <div class="page_list">
                <?php echo $date['html']; ?>

            </div>
        </div>
    </div>
    <div class="right_list">
        <h5>板块列表</h5>
        <?php
        $link = mysqli_connect('localhost','root','123456','sansi_admin');
        $father_list_sql = "select * from sansi_user_admin";
        $father_list_query = mysqli_query($link,$father_list_sql);
        while($father_list_date = mysqli_fetch_assoc($father_list_query)){?>
            <ul>
                <h2><a href="father_list.php?id=<?php echo $father_list_date['id'] ?>"><?php echo $father_list_date['name'];?></a></h2>
                <?php
                $son_list_sql = "select * from sansi_son_admin where father_id={$father_list_date['id']}";
                $son_list_query = mysqli_query($link,$son_list_sql);
                while($son_list_date = mysqli_fetch_assoc($son_list_query)){?>
                    <li><a href="son_list.php?id=<?php echo $son_list_date['id'] ?>"><?php echo $son_list_date['son_name'];?></a></li>
                <?php } ?>
            </ul>
        <?php } ?>
    </div>
</div>
<?php include_once 'footer.inc.php'; ?>
