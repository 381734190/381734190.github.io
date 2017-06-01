<?php
session_start();
header('conten-type:text/html;charset=utf-8');
//检测是否登录，若没登录则转向登录界面
if(!isset($_SESSION['admin_name'])){
	echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
	echo "<script type='text/javascript'>alert('您还未登录，请登陆后操作!');</script>";
    echo "<script type='text/javascript'>window.location.href='index.php'</script>";
    exit();
}

require 'db.php';

//查询留言
$sql = 'SELECT * FROM guest_book';

mysql_select_db( 'bdm273381634_db' );

$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('获取数据失败: ' . mysql_error());
}
$guestNum = 0;
while($result = mysql_fetch_assoc($retval)) {
		$guestNum++;
	}

//查询装修
$sql = 'SELECT * FROM order_zx';

mysql_select_db( 'bdm273381634_db' );

$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('获取装修预约数据失败: ' . mysql_error());
}
$orderNum = 0;
while($result = mysql_fetch_assoc($retval)) {
		$orderNum++;
	}

//获取装修预约
$sql = 'SELECT * from order_zx where order_id = (SELECT max(order_id) FROM order_zx)';

mysql_select_db( 'bdm273381634_db' );

$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('获取装修预约数据失败: ' . mysql_error());
}

while($result = mysql_fetch_assoc($retval)) {
		$project[$i]['order_id'] = $result['order_id'];
		$project[$i]['order_name'] = $result['order_name'];
		$project[$i]['order_phone'] = $result['order_phone'];
		$project[$i]['order_house'] = $result['order_house'];
		$project[$i]['order_area'] = $result['order_area'];
		$project[$i]['order_img'] = $result['order_img'];
		$project[$i]['order_content'] = $result['order_content'];
		$project[$i]['order_ip'] = $result['order_ip'];
		$project[$i]['order_time'] = $result['order_time'];
	}

//案例获取
//现代风格
$sql = 'SELECT * FROM style_xd';
mysql_select_db( 'bdm273381634_db' );
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('现代风格获取数据失败: ' . mysql_error());
}
$styleXd = 0;
while($result = mysql_fetch_assoc($retval)) {
	$styleXd++;
}
//欧式风格
$sql = 'SELECT * FROM style_os';
mysql_select_db( 'bdm273381634_db' );
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('欧式风格获取数据失败: ' . mysql_error());
}
$styleOs = 0;
while($result = mysql_fetch_assoc($retval)) {
	$styleOs++;
}
//美式风格
$sql = 'SELECT * FROM style_ms';
mysql_select_db( 'bdm273381634_db' );
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('美式风格获取数据失败: ' . mysql_error());
}
$styleMs = 0;
while($result = mysql_fetch_assoc($retval)) {
	$styleMs++;
}
//中式风格
$sql = 'SELECT * FROM style_zs';
mysql_select_db( 'bdm273381634_db' );
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('中式风格获取数据失败: ' . mysql_error());
}
$styleZs = 0;
while($result = mysql_fetch_assoc($retval)) {
	$styleZs++;
}
//田园风格
$sql = 'SELECT * FROM style_ty';
mysql_select_db( 'bdm273381634_db' );
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('现代风格获取数据失败: ' . mysql_error());
}
$styleTy = 0;
while($result = mysql_fetch_assoc($retval)) {
	$styleTy++;
}
//混搭风格
$sql = 'SELECT * FROM style_hd';
mysql_select_db( 'bdm273381634_db' );
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('混搭风格获取数据失败: ' . mysql_error());
}
$styleHd = 0;
while($result = mysql_fetch_assoc($retval)) {
	$styleHd++;
}
//工装风格
$sql = 'SELECT * FROM style_gz';
mysql_select_db( 'bdm273381634_db' );
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('工装风格获取数据失败: ' . mysql_error());
}
$styleGz = 0;
while($result = mysql_fetch_assoc($retval)) {
	$styleGz++;
}
//别墅风格
$sql = 'SELECT * FROM style_bs';
mysql_select_db( 'bdm273381634_db' );
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('别墅风格获取数据失败: ' . mysql_error());
}
$styleBs= 0;
while($result = mysql_fetch_assoc($retval)) {
	$styleBs++;
}

$styleNum = $styleXd + $styleOs + $styleMs + $styleZs + $styleTy + $styleHd + $styleGz + $styleBs;

?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="无底蕴，不装修。国风装，舍弃谁？————潢川玄墨装饰设计有限公司">
  <meta name="keyword" content="玄墨装饰,潢川装修,玄墨,潢川玄墨装饰设计,潢川玄墨,xmzs,潢川装饰,玄墨装饰设计">
  <meta name="author" content="Nomo Hsiang">
  <link rel="icon" href="images/ico.png">
  <title>玄墨装饰后台管理中心</title>

  <!--日历css-->
  <link href="css/clndr.css" rel="stylesheet">

  <!--common-->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">

    <!--mystyle-->
    <link href="css/mystyle.css" rel="stylesheet">


  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->
</head>

<body class="sticky-header">

<section>
    <!-- 左边操作栏 start-->
    <div class="left-side sticky-left-side">

        <!--logo and iconic logo start-->
        <div class="logo">
            <a href="main.php"><img src="images/logo.png" alt=""></a>
        </div>

        <div class="logo-icon text-center">
            <a href="main.php"><img src="images/logo_icon.png" alt=""></a>
        </div>
        <!--logo and iconic logo end-->

        <div class="left-side-inner">

            <!--侧边栏导航 start-->
            <ul class="nav nav-pills nav-stacked custom-nav">
                <li class="active"><a href="main.php"><i class="fa fa-home"></i> <span>管理中心</span></a></li>

                <li><a href="order.php"><i class="fa fa-gavel"></i> <span>预约列表</span></a></li>

                <li><a href="style_add.php"><i class="fa fa-mortar-board"></i> <span>案例发布</span></a></li>
                <li class="menu-list nav-active"><a href=""><i class="fa fa-cubes"></i> <span>风格管理</span></a>
                    <ul class="sub-menu-list">
						<li><a href="style_xd.php"> 现代风格</a></li>
						<li><a href="style_os.php"> 欧式风格</a></li>
						<li><a href="style_ms.php"> 美式风格</a></li>
						<li><a href="style_zs.php"> 中式风格</a></li>
						<li><a href="style_ty.php"> 田园地中海</a></li>
						<li><a href="style_hd.php"> 混搭风格</a></li>
						<li><a href="style_gz.php"> 工装风格</a></li>
						<li><a href="style_bs.php"> 别墅风格</a></li>
                    </ul>
                </li>
                 <li><a href="guest_book.php"><i class="fa fa-map-signs"></i> <span>留言板管理</span></a></li>
                <li><a href="index.php?action=logout"><i class="fa fa-sign-in"></i> <span>退出</span></a></li>

            </ul>
            <!--sidebar nav end-->

        </div>
    </div>
    <!-- 左边操作栏 end-->
    
    <!-- 右边内容部分 start-->
    <div class="main-content" >

        <!-- 内容头部 start-->
        <div class="header-section">

            <!--左侧活动按钮 start-->
            <a class="toggle-btn"><i class="fa fa-bars"></i></a>
            <!--左侧活动按钮 end-->
            <b id="Clock" class=" hidden-xs"></b>


            <!--右侧头部按钮 start -->
            <div class="menu-right">
                <ul class="notification-menu">
                    <li>
                        <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <img src="images/photos/user-avatar.png" alt="" />
                            后台管理员
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                            <li><a href="index.php?action=logout"><i class="fa fa-sign-out"></i> 退出登录</a></li>
                        </ul>
                    </li>

                </ul>
            </div>
            <!--右侧头部按钮 end -->

        </div>
        <!-- 内容头部 end-->

        <!-- page heading start-->
        <div class="page-heading">
            <h3>
                管理中心
            </h3>
            <ul class="breadcrumb">
                <li>
                    <a href="#">后台管理中心</a>
                </li>
                <li class="active"> 管理中心 </li>
            </ul>
        </div>
        <!-- page heading end-->

        <!--body wrapper start-->
        <div class="wrapper">
            <!--第1行-->
            <div class="row">
                <div class="col-md-3">
                    <!--statistics start-->
                    <div class="row state-overview">
                        <div class="col-md-12 col-xs-12 col-sm-6">
                            <div class="panel purple">
                                <div class="symbol">
                                    <i class="fa fa-cubes"></i>
                                </div>
                                <div class="state-value">
                                    <div class="value"><?php echo $styleNum; ?></div>
                                    <div class="title">风格案例总数</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row state-overview">
                        <div class="col-md-12 col-xs-12 col-sm-6">
                            <div class="panel blue">
                                <div class="symbol">
                                    <i class="fa fa-map-signs"></i>
                                </div>
                                <div class="state-value">
                                    <div class="value"><?php echo $guestNum; ?></div>
                                    <div class="title"> 网站留言总数 </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row state-overview">
                        <div class="col-md-12 col-xs-12 col-sm-6">
                            <div class="panel red">
                                <div class="symbol">
                                    <i class="fa fa-gavel"></i>
                                </div>
                                <div class="state-value">
                                    <div class="value"><?php echo $orderNum; ?></div>
                                    <div class="title">预约装修总数</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--statistics end-->
                </div>
                <div class="col-md-4">
                    <!--more statistics box start-->
                    <div class="panel">
                        <div class="panel-body">
                            <div class="calendar-block ">
                                <div class="cal1">

                                </div>
                            </div>

                        </div>
                    </div>
                    <!--more statistics box end-->
                </div>
                <div class="col-md-5">
                    <div class="panel blue-box twt-info">
                        <div class="panel-body">
                            <div class="center-block tq text-center">
                                <iframe src="http://www.thinkpage.cn/weather/weather.aspx?uid=UC5D24C960&cid=CHBJ000000&l=zh-CHS&p=SMART&a=1&u=C&s=3&m=0&x=1&d=3&fc=FFFFFF&bgc=&bc=&ti=0&in=0&li=" frameborder="0" scrolling="no" width="500" height="90" allowTransparency="true"></iframe>
                            </div>
                        </div>
                    </div>
                    <div class="panel">
                        <div class="panel-heading">
                            最新预约信息
                        </div>
                        <div class="panel-body">
                            <div class="media usr-info">
                                <div  class="pull-left">
                                    <img class="thumb" src="images/photos/user<?php echo $project[$i]['order_img']; ?>.png" alt=""/>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading"><?php echo $project[$i]['order_name']; ?> 丨 <span><?php echo $project[$i]['order_phone']; ?></span></h4>
                                    
                                    <span><?php echo $project[$i]['order_house']; ?></span>
                                    <i><?php echo $project[$i]['order_area']; ?></i>
                                    <i><?php echo $project[$i]['order_time']; ?></i>
                                    <p><?php echo $project[$i]['order_content']; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer custom-trq-footer text-center">
                            <a class="tea-a" style="font-size: 20px" href="order.php"><i class="fa fa-bookmark"></i> 预约列表</a>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <!--body wrapper end-->

        <!--footer section start-->
        <footer>
            2017 &copy; Powered by Nomo Hsiang
        </footer>
        <!--footer section end-->
    </div>
    <!-- 右边内容部分  end-->
</section>

<!-- Placed js at the end of the document so the pages load faster -->
<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="js/jquery-migrate-1.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/modernizr.min.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<script src="js/bootstrapValidator.js"></script>

<!--Calendar-->
<script src="js/calendar/clndr.js"></script>
<script src="js/calendar/evnt.calendar.init.js"></script>
<script src="js/calendar/moment-2.2.1.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"></script>

<!--common scripts for all pages-->
<script src="js/scripts.js"></script>
<script src="js/myjs.js"></script>




</body>
</html>