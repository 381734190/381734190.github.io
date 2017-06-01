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

//删除代码
if(isset($_GET['del_id'])){
	$guest_id = $_GET['del_id'];
	$sql = "DELETE FROM guest_book WHERE guest_id = '$guest_id'";
	mysql_select_db( 'bdm273381634_db' );
	$retval = mysql_query( $sql, $conn );
	mysql_query($sql);
	if(! $retval )
	{
	  die('删除失败！: ' . mysql_error()).'<a href="guest_book.php">点击返回</a>';
	}
	header("Location: guest_book.php");
	exit(0);
}else{

    mysql_query("set names utf8");
    $sql = 'SELECT * FROM guest_book';

    mysql_select_db( 'bdm273381634_db' );

    $retval = mysql_query( $sql, $conn );
    if(! $retval )
    {
    die('获取数据失败: ' . mysql_error());
    }

    $i = 0;
    while($result = mysql_fetch_assoc($retval)) {
            $project[$i]['guest_id'] = $result['guest_id'];
            $project[$i]['guest_name'] = $result['guest_name'];
            $project[$i]['guest_mail'] = $result['guest_mail'];
            $project[$i]['guest_content'] = $result['guest_content'];
            $project[$i]['guest_ip'] = $result['guest_ip'];
            $project[$i]['guest_time'] = $result['guest_time'];
            $i++;
    }

}

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

    <title>留言板管理--玄墨装饰后台管理中心</title>

  <!--data table-->
  <link rel="stylesheet" href="js/data-tables/DT_bootstrap.css" />

  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">
    <!--mystyle-->
    <link href="css/mystyle.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->
    <style>
        .jianjie{
            max-width: 350px;
        }
		
    </style>
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
                <li><a href="main.php"><i class="fa fa-home"></i> <span>管理中心</span></a></li>

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
                 <li  class="active"><a href="guest_book.php"><i class="fa fa-map-signs"></i> <span>留言板管理</span></a></li>
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
                            <!--<li><a href="#"><i class="fa fa-user"></i>  个人资料</a></li>-->
                            <!--<li><a href="#"><i class="fa fa-cog"></i>  设置</a></li>-->
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
                留言板管理
            </h3>
            <ul class="breadcrumb">
                <li>
                    <a href="main.php">后台管理中心</a>
                </li>
                <li class="active"> 留言板管理 </li>
            </ul>
        </div>
        <!-- page heading end-->

        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                        <div class="panel-body">
                            <div class="space15"></div>
                            <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>姓名</th>
                                    <th>邮箱</th>
                                    <th>留言内容</th>
                                    <th>IP地址</th>
                                    <th>时间</th>
                                    <th>删除</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
								<?php 
								for ($i=0; $i < count($project); $i++) { 
								?>
									<tr class="">
										<td><?php echo $project[$i]['guest_id']; ?></td>
										<td><?php echo $project[$i]['guest_name']; ?></td>
										<td><?php echo $project[$i]['guest_mail']; ?></td>
										<td class="jianjie"><?php echo $project[$i]['guest_content']; ?></td>
										<td><?php echo $project[$i]['guest_ip']; ?></td>
										<td><?php echo $project[$i]['guest_time']; ?></td>
										<td><a href="guest_book.php?del_id=<?php echo $project[$i]['guest_id']; ?>" onclick = "return confirm('确认删除？');">删除</a></td>
										<td><a href="http://www.ip138.com/ips1388.asp?ip=<?php echo $project[$i]['guest_ip']; ?>&action=2" target="_blank" >查询IP</a></td>
									</tr>
								<?php
								}
								?>

                                </tbody>
                            </table>
                        </div>
                    </section>
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
    <!-- main content end-->
</section>

<!-- Placed js at the end of the document so the pages load faster -->
<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="js/jquery-migrate-1.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/modernizr.min.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<script src="js/bootstrapValidator.js"></script>

<!--data table-->
<script type="text/javascript" src="js/data-tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="js/data-tables/DT_bootstrap.js"></script>

<!--common scripts for all pages-->
<script src="js/scripts.js"></script>
<script src="js/myjs.js"></script>

<!--script for editable table-->
<script src="js/editable-table.js"></script>

<!-- END JAVASCRIPTS -->
<script>
    jQuery(document).ready(function() {
        EditableTable.init();

        $("#filePic").change(function () {
            $("#docPic").val($("#filePic").val());
        });
    });


</script>

</body>
</html>