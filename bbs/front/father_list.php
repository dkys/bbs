<?php
$title = "父板块列表页";
include_once "skip.login.php";
include_once "father.list.page.php";
$memeber_id = is_login($link);

if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
    skip('父板块id参数不合法!','index.php');
    exit();
}
//mysqli_num_rows()此函数只对select查询语句有效,如果insert into和delete和update想要查询返回行数需要用到 mysqli_affected_rows
$link = mysqli_connect('localhost','root','123456','sansi_admin');
$sql_father = "select * from sansi_user_admin where id={$_GET['id']}";
$query_father = mysqli_query($link,$sql_father);
if(mysqli_num_rows($query_father) != 1){
    skip('父板块id参数不存在!','index.php');
    exit();
}
$date_father = mysqli_fetch_assoc($query_father);
//***********操作子版块数据库**********
$sql_son = "select * from sansi_son_admin where father_id={$date_father['id']}";
$query_son = mysqli_query($link,$sql_son);
$son_id = '';//要先给一个定义的变量 否则$son_id .= $date_son['id'].',';就会报错未定义的变量
$son_name_list = '';
//将子版块名字遍历出来 就需要用到 .= 来拼接 否则无法想要实现效果
while($date_son = mysqli_fetch_assoc($query_son)){
    $son_id .= $date_son['id'].',';// .= 表示每循环一次拼接一次id并且以逗号 ',' 隔开
    $son_name_list .= "<a href='son_list.php?id={$date_son['id']}'>{$date_son['son_name']}</a> ";
}
$son_id = trim($son_id,',');// 去除字符串左右的','逗号
//echo $son_id;
//exit;
//*************操作文章数据库**********
//获取所在子版块的文章总数
if($son_id == ''){
    $son_id = 0;
}
$sql_content = "select count(*) from sansi_content where son_id IN (select sansi_son_admin.id FROM sansi_son_admin WHERE sansi_son_admin.father_id={$_GET['id']})";
$query_content = mysqli_query($link,$sql_content);
//获取帖子总数
$all_count = mysqli_fetch_row($query_content);
//获取当天发帖数量
$tady_content = "select count(*) from sansi_content where son_id IN({$son_id}) AND time>CURRENT_DATE()";
$query_tady = mysqli_query($link,$tady_content);
$tady_count = mysqli_fetch_row($query_tady);
include_once "header.inc.php";

?>
<div class="banner">
    <a href="index.php" class="yy">首页</a>&gt;<a href="father_list.php?id=<?php echo $date_father['id'] ?>" class="tow"><?php echo $date_father['name'] ?></a>
</div>
<div class="box_content">
<div class="content1">
   <h3><?php echo $date_father['name'] ?></h3>
    <div class="bx">
        今日:
        <span><?php echo $tady_count[0] ?></span>
        总贴:
        <span><?php echo $all_count[0] ?></span>
    </div>
    <div class="pa">子版块:
        <?php echo $son_name_list; ?>
    </div>
    <div class="pages">
        <a href="publish.php?fatherid=<?php echo $_GET['id']; ?>" target="_blank" class="publish btns"></a>
        <div class="page_list">
            <?php
            $date = pageList($all_count[0],5);
            echo $date['html'];
            ?>
        </div>
    </div>

    <?php
    $content_sql = "select sansi_content.title,sansi_content.id,sansi_content.time,sansi_content.times,sansi_son_admin.son_name,sansi_members.name,sansi_members.photo from
sansi_content,sansi_son_admin,sansi_members where
son_id IN({$son_id}) AND
sansi_content.son_id=sansi_son_admin.id AND
sansi_content.member_id=sansi_members.id {$date['limit']}";
    $content_query = mysqli_query($link,$content_sql);
    while($date_content = mysqli_fetch_assoc($content_query)){
        //获取当前页的回帖数量
        $sqlnunm = "select COUNT(*) from sansi_reply WHERE content_id={$date_content['id']}";
        $numrel = mysqli_query($link,$sqlnunm);
        $num = mysqli_fetch_row($numrel);
        $titles = addslashes($date_content['title']);



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
<!--                --><?php //$reurl = urlencode($_SERVER['REQUEST_URI']);
//                $deleteurl = urlencode('content_delete.php'.'&contentid='.$date_content['id']);
//                if(isset($_GET['admin']) || $_GET['admin']==1){
//                    echo "<span class='div_down' style='margin-left: 60px;'><a href='content_update.php?contentid={$date_content['id']}' target='_blank'>编辑</a>|<a href='tiaozhuan.php?name={$date_content['title']}&reurl={$reurl}&deleteurl={$deleteurl}'>删除</a></span>";
//                }
                ?>
            </li>
        </ul>

 <?php  } ?>

<!--        <ul class="content_list">-->
<!--            <li>-->
<!--                <a href=""><img src="./style/big_1.jpg" alt=""></a>-->
<!--                <a href="" class="a1">[分类]</a><a href="" class="a2">文章标题</a>-->
<!--                <p class="p1">回复<span>66</span></p>-->
<!--                <p class="p2">浏览<span>33</span></p>-->
<!--                <p class="div_down">楼主：隐姓埋名 2014-12-08    最后回复：2014-12-08</p>-->
<!--            </li>-->
<!--        </ul>-->
    <div class="bx_bottom">
        <a href="publish.php?fatherid=<?php echo $_GET['id'] ?>" target="_blank" class="publish btns"></a>
        <div class="page_list">
            <?php echo $date['html']; ?>
<!--            <a href="">&lt;&lt;上一页</a>-->
<!--            <a href="">1</a>-->
<!--            <a href="">2</a>-->
<!--            <a href="">3</a>-->
<!--            <a href="">4</a>-->
<!--            <a href="">5</a>-->
<!--            <a href="">下一页&gt;&gt;</a>-->
        </div>
    </div>
</div>
    <div class="right_list">
    <h5>板块列表</h5>
        <?php
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
<?php include_once "footer.inc.php"; ?>
