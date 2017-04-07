<?php
function upload($new_path,$filesize,$key,$unit_arr=array('jpg','jpeg','gif','png')){
    $return_date = array();
//处理php配置文件 最大文件大小
    $phpini_upload_max_siz = ini_get('upload_max_filesize');
    $phpini_unit = strtoupper(substr($phpini_upload_max_siz,-1));
    $phpini_num = substr($phpini_upload_max_siz,0,-1);
    $phpini_bityes = $phpini_num*get_multiple($phpini_unit);
//处理上传文件大小
    $filesize_unit = strtoupper(substr($filesize,-1));
    $filesize_num = substr($filesize,0,-1);
    $filesize_bityes = $filesize_num*get_multiple($filesize_unit);

    if($filesize_bityes > $phpini_bityes){
        $return_date['error'] = '上传文件过大!';
        $return_date['return'] = false;
        return $return_date;
    }
    $arr_erron = array(
        1=>'上传的文件超过了php.ini中upload_max_filesize 选项限制的值',
        2=>'上传文件的大小超过了作者指定的值',
        3=>'文件只有部分被上传',
        4=>'没有文件被上传',
        6=>'找不到临时文件夹',
        7=>'文件写入失败'
    );
    $file_myfile = $_FILES[$key];
    if(!isset($file_myfile['error'])){
        $return_date['error'] = '未知原因导致上传失败';
        $return_date['return'] = false;
        return $return_date;
    }

    if($file_myfile['error']!=0){
        $return_date['error'] = $arr_erron[$file_myfile['error']];
        $return_date['return'] = false;
        return $return_date;
    }
    if(!is_uploaded_file($file_myfile['tmp_name'])){
        $return_date['error'] = '文件不是同HTTP上传的';
        $return_date['return'] = false;
        return $return_date;
    }
    if($file_myfile['size']>$filesize_bityes){
        $return_date['error'] = '上传文件大小超出了作者设置的大小'.$filesize;
        $return_date['return'] = false;
        return $return_date;
    }
    $unit=pathinfo($file_myfile['name'])['extension'];

    if(!isset($unit)){
        $unit='';
    }
    if(!in_array($unit,$unit_arr)){
        $return_date['error'] = '文件后缀不合法!必须是'.implode(',',$unit_arr).'其中的一个';
        $return_date['return'] = false;
        return $return_date;
    }
    $arr = rtrim($new_path,'/');
    $new_paths = $arr.'/';
    if(!file_exists($new_paths)){
        if(!mkdir($new_paths,0777,true)){
            $return_date['error'] = '上传文件保存目录创建失败,请检查权限!';
            $return_date['return'] = false;
            return $return_date;
        }
    }

    $new_file_name = str_replace('.','',uniqid(mt_rand(10000,99999),true));
    if($file_myfile['tmp_name'] != ''){
        $new_file_name .= ".{$unit}";
    }

    if(!move_uploaded_file($file_myfile['tmp_name'],$new_paths.$new_file_name)){
        $return_date['error'] = '上传文件保存失败,请检查权限!';
        $return_date['return'] = false;
        return $return_date;
    }
    $return_date['save_path'] = $new_paths.$new_file_name;
    $return_date['filename'] = $new_file_name;
    $return_date['return'] = true;
    return $return_date;
}

function get_multiple($unit){
    switch($unit){
        case 'K':
            $multiple = 1024;
            return $multiple;
        case 'M':
            $multiple = 1024*1024;
            return $multiple;
        case 'G':
            $multiple = 1024*1024*1024;
            return $multiple;
        default:
            return false;
    }
}




?>