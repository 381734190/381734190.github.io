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

if (isset($_POST['addRec'])) {
	$dbhost = 'bdm195587110.my3w.com';  //mysql服务器主机地址
	$dbuser = 'bdm195587110';      //mysql用户名
	$dbpass = 'jazhyzw010';//mysql用户名密码
	$conn = mysql_connect($dbhost, $dbuser, $dbpass);
	if(! $conn )
	{
	  die('连接失败: ' . mysql_error());
	}
    mysql_query("set names utf8");

	

    $rec_title = $_POST['recTitle'];
	$rec_class = $_POST['recClass'];
	$rec_jobs = $_POST['recJobs'];
    $rec_demand = $_POST['recDemand'];

	
//    设置北京时间
    date_default_timezone_set('PRC');
    $nowDate = date("Y-m-d");


//    插入语句	
	if($rec_class=="talent"){
		$sql = "INSERT INTO talent_rec" .
		"(rec_title,rec_jobs, rec_demand,rec_time) " .
		"VALUES " .
		"('$rec_title','$rec_jobs','$rec_demand','$nowDate')";
	}else if($rec_class=="society"){
		$sql = "INSERT INTO society_rec" .
        "(rec_title,rec_jobs, rec_demand,rec_time) " .
        "VALUES " .
        "('$rec_title','$rec_jobs','$rec_demand','$nowDate')";
	}else{
		$sql = "INSERT INTO school_rec" .
        "(rec_title,rec_jobs, rec_demand,rec_time) " .
        "VALUES " .
        "('$rec_title','$rec_jobs','$rec_demand','$nowDate')";
	}



//    选择数据库
    mysql_select_db( 'bdm195587110_db' );

//    传输sql语句
    $retval = mysql_query($sql, $conn);
    if (!$retval) {
        die('插入数据失败: ' . mysql_error());
    }else{
		echo "<script>alert('招聘信息发布成功！');location.href='add_rec.php';</script>";   
	}

//    断开数据库连接
    mysql_close($conn);
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="ThemeBucket">
  <link rel="shortcut icon" href="#" type="image/png">

    <title>发布招聘信息--后台管理中心</title>

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

                <li><a href="add_news.php"><i class="fa fa-tags"></i> <span>新闻发布</span></a></li>
                <li><a href="news_table.php"><i class="fa fa-newspaper-o"></i> <span>新闻列表</span></a></li>
                <li><a href="guest_book.php"><i class="fa fa-map-signs"></i> <span>留言板管理</span></a></li>

				<li class="active"><a href="add_rec.php"><i class="fa fa-mortar-board"></i> <span>发布招聘</span></a></li>
                <li class="menu-list"><a href=""><i class="fa fa-institution"></i> <span>招聘管理</span></a>
                    <ul class="sub-menu-list">
						<li><a href="staff_welfare.php"> 员工福利</a></li>
						<li><a href="talent_rec.php"> 人才招聘</a></li>
						<li><a href="society_rec.php"> 社会招聘</a></li>
						<li><a href="school_rec.php"> 校园招聘</a></li>
                    </ul>
                </li>
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
                发布招聘信息
            </h3>
            <ul class="breadcrumb">
                <li>
                    <a href="main.php">后台管理中心</a>
                </li>
                <li class="active"> 发布招聘信息 </li>
            </ul>
        </div>
        <!-- page heading end-->

        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <div class="col-sm-12">
                        <section class="panel">
                            <div class="panel-heading">发布招聘信息</div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-7">

                                        <form class="form-horizontal" id="addREC" method="post" enctype="multipart/form-data" action="<?php $_PHP_SELF ?>" >

                                            <div class="form-group">
                                                <label for="recTitle" class="col-sm-2 control-label">岗位名称：</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="recTitle" id="recTitle" >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="recClass" class="col-sm-2 control-label">招聘分类：</label>
                                                <div class="col-sm-10">
													<select class="form-control" name="recClass" id="recClass" >
													  <option value="">--请选择--</option>
													  <option value="talent">人才招聘</option>
													  <option value="society">社会招聘</option>
													  <option value="school">校园招聘</option>
													</select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="recJobs" class="col-sm-2 control-label">职位描述：</label>
                                                <div class="col-sm-10">
                                                    <script id="recJobs" name="recJobs" type="text/plain"></script>
                                                </div>
                                            </div>

											 <div class="form-group">
                                                <label for="recDemand" class="col-sm-2 control-label">任职要求：</label>
                                                <div class="col-sm-10">
                                                    <script id="recDemand" name="recDemand" type="text/plain"></script>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10 ">
                                                    <!--<button type="button" id="add-section" class="btn btn-warning">添加章节</button>-->
                                                    <button type="submit" name="addRec" class="btn btn-success">提交</button>
                                                    <button type="reset" class="btn btn-default">重置</button>
                                                </div>
                                            </div>
                                        </form>


                                    </div>
                                    <div class="col-sm-5">
                                        <!--<img src="images/test.jpg" class="img-responsive classPic center-block" alt="">-->
                                        <p><b>注意：</b></p>
										<p>职位描述及任职要求在非特殊情况下不要改变文字样式，直接输入即可。</p>
										<p>例子：</p>
										<p>1. 能够独立策划撰写线上、线下活动方案、微信、微博运营管理；</p>
										<p>2. 全日制本科及以上学历，市场营销、管理类专业优先；</p>
										<p>3. 工作责任心强，表达沟通佳，具备团队合作精神。</p>
                                    </div>
                                </div>

                            </div>
                        </section>


                </div>
            </div>
        </div>
        <!--body wrapper end-->

        <!--footer section start-->
        <footer>
            2016 &copy; Powered by Nomo Hsiang
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
<!-- 配置文件 -->
<script type="text/javascript" src="js/ueditor/ueditor.config.js"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="js/ueditor/ueditor.all.min.js"></script>
<!-- END JAVASCRIPTS -->
<script>
    $(function() {
        EditableTable.init();
        $("#filePic").change(function () {
            $("#docPic").val($("#filePic").val());
        });
        $("#TeaPic").change(function () {
            $("#docTeaPic").val($("#TeaPic").val());
        });
        $("#fileData").change(function () {
            $("#docData").val($("#fileData").val());
        });
        var ue = UE.getEditor('recJobs', {
            toolbars: [
                [
                    'undo', //撤销
                    'redo', //重做
                    'bold', //加粗
                    'italic', //斜体
                    'underline', //下划线
                    'strikethrough', //删除线
                    'source', //源代码
                    'horizontal', //分隔线
                    'link', //超链接
                    'unlink', //取消链接

//                    'paragraph', //段落格式
//                    'simpleupload', //单图上传
//                    'insertimage', //多图上传

                    'searchreplace', //查询替换
                    'justifyleft', //居左对齐
                    'justifyright', //居右对齐
                    'justifycenter', //居中对齐
                    'justifyjustify', //两端对齐

                    'fullscreen', //全屏
//                     'insertframe', //插入Iframe

                    'drafts' // 从草稿箱加载
                ]
            ],
            initialFrameHeight:250,
            zIndex : 1500,
            autoHeightEnabled: true,
            autoFloatEnabled: true,
            elementPathEnabled:false,
            wordCount:false
        });

		var ue1 = UE.getEditor('recDemand', {
            toolbars: [
                [
                    'undo', //撤销
                    'redo', //重做
                    'bold', //加粗
                    'italic', //斜体
                    'underline', //下划线
                    'strikethrough', //删除线
                    'source', //源代码
                    'horizontal', //分隔线
                    'link', //超链接
                    'unlink', //取消链接

//                     'paragraph', //段落格式
//                    'simpleupload', //单图上传
//                    'insertimage', //多图上传

                    'searchreplace', //查询替换
                    'justifyleft', //居左对齐
                    'justifyright', //居右对齐
                    'justifycenter', //居中对齐
                    'justifyjustify', //两端对齐

                    'fullscreen', //全屏
//                     'insertframe', //插入Iframe

                    'drafts' // 从草稿箱加载
                ]
            ],
            initialFrameHeight:250,
            zIndex : 1500,
            autoHeightEnabled: true,
            autoFloatEnabled: true,
            elementPathEnabled:false,
            wordCount:false
        });

        ue.ready(function() {
            $('#addREC').submit(function (e) {
                if(ue.hasContents()==false){
                    alert('职位描述不能为空！');
                    e.preventDefault();
                }
				if(ue1.hasContents()==false){
                    alert('任职要求不能为空！');
                    e.preventDefault();
                }
            });

        });

    });


</script>
</body>
</html>
