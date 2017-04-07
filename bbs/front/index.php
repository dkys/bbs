<?php
$title = "首页-三思";
include_once "skip.login.php";

$memeber_id=is_login($link);

include_once "header.inc.php";
?>
<div class="content">
    <div class="title_top">热门动态</div>
    <div class="list_a">
        <a href="">[PHP]</a>
        <a href="">php实战项目教程录制中...</a>
    </div>
    <?php
    $link = mysqli_connect('localhost','root','123456','sansi_admin');
    $sql1 = "select * from sansi_user_admin order by sort DESC";
    $query1 = mysqli_query($link,$sql1);
    while($date_father = mysqli_fetch_assoc($query1)) { ?>
        <div class='title'><a href="father_list.php?id=<?php echo $date_father['id']; ?>"><?php echo $date_father['name']; ?></a></div>
        <?php
        $sql2 = "select * from sansi_son_admin where father_id={$date_father['id']} order by sort DESC";
        $query2 = mysqli_query($link, $sql2);
        if (mysqli_affected_rows($link)) {
            while ($date_son = mysqli_fetch_assoc($query2)) {
                $sql3 = "select count(*) from sansi_content where son_id={$date_son['id']} and time > CURDATE()";
                $query3 = mysqli_query($link,$sql3);
                $conut_tady = mysqli_fetch_row($query3);
                $sql4 = "select count(*) from sansi_content where son_id={$date_son['id']}";
                $query4 = mysqli_query($link,$sql4);
                $count_all = mysqli_fetch_row($query4);
                $son = <<<A
        <div class="box_1">
            <h2><a href="son_list.php?id={$date_son['id']}">{$date_son['son_name']}</a><span>(今日{$conut_tady[0]})</span></h2>
            <h2>帖子：$count_all[0]</h2>
        </div>

A;
                echo $son;
            }
        } else {
            echo "子版块正在规划中!";
        }
    }?>
<!--    <div class="title">JVAVA视频教程区</div>-->
<!--    <div class="classList">暂无子板块</div>-->
<!--    <div class="title">HTML5 css教程区</div>-->
<!--    <div class="classList">暂无子板块</div>-->
<!--    <div class="title">编程语言交流与讨论</div>-->
<!--    <div class="box_all">-->
<!--        <div class="box_1">-->
<!--            <h2><a href="">php插件</a><span>(今日38)</span></h2>-->
<!--            <h2>帖子：1939539</h2>-->
<!--        </div>-->
<!--        <div class="box_2">-->
<!--            <h2><a href="">php安装与使用</a><span>(今日38)</span></h2>-->
<!--            <h2>帖子：1939539</h2>-->
<!--        </div>-->
<!--        <div class="box_3">-->
<!--            <h2><a href="">php视频教程</a><span>(今日38)</span></h2>-->
<!--            <h2>帖子：1939539</h2>-->
<!--        </div>-->
<!--        <div class="box_4">-->
<!--            <h2><a href="">java视频教程</a><span>(今日38)</span></h2>-->
<!--            <h2>帖子：1939539</h2>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<?php include_once "footer.inc.php"; ?>
