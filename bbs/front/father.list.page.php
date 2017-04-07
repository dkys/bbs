<?php
/*$page_count:帖子总数
$pageSize:每一页显示的文章数
$btn_num:每一页显示的按钮数目(默认显示10个)
$num:总按钮数目即:总页数(总按钮数) = 帖子总数/每一页显示的文章数
$page:当前页

*/
function pageList($page_count,$pageSize,$btn_num=3,$page='page'){
    if(!isset($_GET[$page]) || !is_numeric($_GET[$page]) || $_GET[$page] == '' || $_GET[$page] < 1){
        $_GET[$page] = 1;
    }
    if(empty($page_count)){
        $date = array('html'=>'','limit'=>'');
        return $date;
    }

    //总页数
    $num = ceil($page_count/$pageSize);

if($_GET[$page] > $num){
    $_GET[$page]=$num;
}

    //处理URL
    //获取当前页面的URL的地址,并把参数和path(路径)拆分后存入数组中
    $array = parse_url($_SERVER['REQUEST_URI']);
    //判断URL是否带有参数
    if(isset($array['query'])){
        //如果URL带有参数并且有多个参数,则先把参数部分拆分成数组,
        parse_str($array['query'],$arr_query);
        //把带有页码号的参数从数组中删除
        unset($arr_query[$page]);
        //判断页码号的参数被删除之后数组是否为空(也就是只有页码号一个参数)
        if(empty($arr_query)){
            //如果为空则输出URL连上页码下标
            $url = "{$array['path']}?$page=";
        }else{
            //如果删除页码好参数后数组不为空,则把从新编码数组剩下的参数,变成URL的参数
            $str = http_build_query($arr_query);
            //并且办编码后的参数从新放链接在URL上,并且加上页码号的下标
            $url = "{$array['path']}?{$str}&$page=";
        }
        //如果URL中没有任何参数,则输出URL连上页码下标
    }else{
        $url = "{$array['path']}?$page=";
    }
    //第一页
    $start = ($_GET[$page]-1)*$pageSize;
    $limit = "limit {$start},{$pageSize}";
    $html = '';
if($btn_num >= $num){
    for($i=1;$i<=$num;$i++){
        if($i==$_GET[$page]){
            $html[$i] = "<span class='spandown'>$i </span>";
        }else{
            $html[$i] = "<a href='{$url}{$i}'>$i</a> ";
        }
    }
}else{
    $start_left = $_GET[$page] - floor(($btn_num-1)/2);
    if($start_left<1){
        $start_left=1;
    }
    //如果(最左边的按钮号码+每页显示出来的按钮号-1[正常是应该等于总按钮数目]) 大于 总按钮数目
    //让最左边开始按钮 = 总按钮数-每页显示的按钮数+1; 这样就纠正了最后一页按钮数目超出总页码数
    //$start_left:最左边的页码数
    if($start_left+$btn_num-1>$num){
        $start_left=$num-$btn_num+1;
    }
    for($i = 1;$i <= $btn_num;$i++){
        if($_GET[$page]==$start_left){
           $html[$start_left] = "<span class='spandown'>{$start_left}</span>";
        }else{
           $html[$start_left] = "<a href='{$url}{$start_left}'>{$start_left}</a> ";
        }
        $start_left++;
        }
        //让数组内的指针指向第一个元素
        reset($html);
        //获取第一个元素的索引值 / key() 获取当前元素的索引值
        $first_key = key($html);
        //让数组内的指针指向最后一个元素
        end($html);
        //获取最后一个元素的索引值
        $end_key = key($html);
    //当显示按钮不小于3的时候相关操作
        if(count($html)>=3){
            //当第一个按钮不是1的时候 则吧第一个分页按钮替换成1...
            if($first_key !=1){
                //删除数组第一个元素
            array_shift($html);
                //在数组的最前面添加元素 并且从新排列索引
                array_unshift($html,"<a href='{$url}1'>1...</a>");
            }
            //当最后一个按钮不等于总页码数的时候 则吧最后一个分页按钮替换成...+最大页码数
            if($end_key != $num){
                //删除数组最后一个元素
                array_pop($html);
                //在数组最后面添加元素
                array_push($html,"<a href='{$url}{$num}'>...{$num}</a>");
            }
            if($_GET[$page] != 1){
                $unpage = $_GET[$page]-1;
                //在数组前面添加 上一页
                array_unshift($html,"<a href='{$url}{$unpage}'><<上一页</a>");
            }
            if($_GET[$page] != $num){
                $unpage = $_GET[$page]+1;
                //在数组最后面添加下一页
                array_push($html,"<a href='{$url}{$unpage}'>下一页>></a>");
            }

        }
    }
    $html = implode(' ',$html);
    $date = array('html'=>$html,'limit'=>$limit);
    return $date;
//    echo $btn_num;
//    return $html;
}


//$a=pageList(8,1,6);
//echo $a;

?>