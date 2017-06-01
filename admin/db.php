<?php
    $dbhost = 'bdm273381634.my3w.com';  //mysql服务器主机地址
    $dbuser = 'bdm273381634';      //mysql用户名
    $dbpass = 'xuanmocf';//mysql用户名密码
    $conn = mysql_connect($dbhost, $dbuser, $dbpass);
    if(! $conn )
    {
    die('连接失败: ' . mysql_error());
    }
    mysql_query("set names utf8");
?>