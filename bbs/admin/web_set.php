<?php
$title = '网站设置';
include_once 'skip.login.php';
include_once 'header.lnc.php';


?>
    <div class="right">
        <div class="title">站点设置</div>
        <form action="add_father.php" method="post">
            <table class="list_b">
                <tr>
                    <td>设置网站标题</td>
                    <td><input type="text" placeholder="请输入网站标题" name="title"></td>
                    <td>网站首页的标题</td>
                </tr>
                <tr>
                    <td>设置网站关键字</td>
                    <td><input type="text" placeholder="请输入关键字" name="keywords"></td>
                    <td>SEO关键字搜索</td>
                </tr>
                <tr>
                    <td>设置网站描述</td>
                    <td><textarea cols="35" rows="8" placeholder="请输入网站描述" name="description"></textarea></td>
                    <td>描述</td>
                </tr>
            </table>
            <input type="submit" name="submit" class="btn" value="设置">
        </form>
    </div>
<?php include_once 'dibu.inc.php'; ?>