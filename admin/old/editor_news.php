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

$dbhost = 'bdm195587110.my3w.com';  //mysql服务器主机地址
$dbuser = 'bdm195587110';      //mysql用户名
$dbpass = 'jazhyzw010';//mysql用户名密码
$conn = mysql_connect($dbhost, $dbuser, $dbpass);
if(! $conn )
{
  die('连接失败: ' . mysql_error());
}
mysql_query("set names utf8");

if (isset($_GET['edit_id'])) {
	$news_id = $_GET['edit_id'];
	$sql = 'SELECT * FROM news_tbl
			WHERE news_id='.$news_id;

	mysql_select_db( 'bdm195587110_db' );

	$retval = mysql_query( $sql, $conn );
	if(! $retval )
	{
	  die('获取数据失败: ' . mysql_error());
	}
	
	while($result = mysql_fetch_assoc($retval)) {
			$project['news_id'] = $result['news_id'];
			$project['news_title'] = $result['news_title'];
			$project['news_description'] = $result['news_description'];
			$project['news_content'] = $result['news_content'];
			$project['news_author'] = $result['news_author'];
			$project['news_img'] = $result['news_img'];
			$project['news_time'] = $result['news_time'];
		}
	
	
	//上传图片
	//全局变量
	$arrType=array('image/jpg','image/jpeg','image/gif','image/png','image/bmp','image/pjpeg','image/x-png');

	$max_size='2000000';      // 最大文件限制（单位：byte）2M
	$upfile='../upimg'; //图片目录路径


	$file=$_FILES['newsImg'];//name值
	  
	if($_SERVER['REQUEST_METHOD']=='POST'){ //判断提交方式是否为POST
		if(!is_uploaded_file($file['tmp_name'])){
			$picName = $_POST['docPic'];
		}else{
			if(!is_uploaded_file($file['tmp_name'])){ //判断上传文件是否存在
				echo "<font color='#FF0000'>文件不存在！</font>";
				exit;
			}
		   
			if($file['size']>$max_size){  //判断文件大小是否大于500000字节
				echo "<font color='#FF0000'>上传文件太大！</font>";
				exit;
			} 
			if(!in_array($file['type'],$arrType)){  //判断图片文件的格式
				echo "<script>alert('*只允许上传jpg|jpeg|png|x-png|bmp|pjpeg|gif 格式的图片！');</script>";
				exit;
			}
			if(!file_exists($upfile)){  // 判断存放文件目录是否存在
				mkdir($upfile,0777,true);
			} 

		   $imageSize=getimagesize($file['tmp_name']);//文件分辨率数组
		   $img=$imageSize[0].'*'.$imageSize[1];//长*宽
		   $fname=$file['name'];
		   $ftype=explode('.',$fname);//分解文件名称
		   $imgDate = time();
		   $ftype[0]= $imgDate;
		   $picName=$upfile."/news_".$ftype[0].".".$ftype[1];//以时间为单位设置文件名称
		   if(file_exists($picName)){
			   $picName=$upfile."/news_".$ftype[0]."0".".".$ftype[1];//重名后设置文件名称
			}
		   if(!move_uploaded_file($file['tmp_name'],$picName)){  //文件移动失败
			   echo "<script>alert('图片上传失败！请稍后重试。');</script>";
			   exit;
			}
		}
		//else{
		//	echo "<font color='#FF0000'>图片文件上传成功！</font><br/>";
		//	echo "<font color='#0000FF'>图片大小：$img</font><br/>";
		//	echo "图片预览：<br><div style='border:#F00 1px solid; width:200px'>
		//	<img src=\"".$picName."\" width=200px>".$fname."</div>";
		//}
	}
	//上传图片END



	if (isset($_POST['addNews'])) {

		$news_title = $_POST['newsTitle'];
		$news_description = $_POST['newsDescription'];
		$news_content = $_POST['newsContent'];
		$news_author = $_POST['newsAuthor'];
			
		
	//    设置北京时间
		date_default_timezone_set('PRC');
		$nowDate = date("Y-m-d");

	//    插入语句		
		$sql = "UPDATE news_tbl
				SET news_title= '$news_title',
				news_description= '$news_description',
				news_content= '$news_content',
				news_author= '$news_author',
				news_img= '$picName',
				news_time= '$nowDate'
				WHERE news_id= $news_id";

	//    选择数据库
		mysql_select_db( 'bdm195587110_db' );

	//    传输sql语句
		$retval = mysql_query($sql, $conn);
		if (!$retval) {
			die('修改数据失败: ' . mysql_error());
		}
		echo "<script>alert('新闻修改成功！');location.href='news_table.php';</script>"; 

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

    <title>修改新闻--后台管理中心</title>

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
                <li class="active"><a href="news_table.php"><i class="fa fa-newspaper-o"></i> <span>新闻列表</span></a></li>
                <li><a href="guest_book.php"><i class="fa fa-map-signs"></i> <span>留言板管理</span></a></li>

               <li><a href="add_rec.php"><i class="fa fa-mortar-board"></i> <span>发布招聘</span></a></li>
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
                修改新闻
            </h3>
            <ul class="breadcrumb">
                <li>
                    <a href="main.php">后台管理中心</a>
                </li>
                <li>
                    <a href="#">新闻管理</a>
                </li>
                <li class="active"> 修改新闻 </li>
            </ul>
        </div>
        <!-- page heading end-->

        <!--body wrapper start-->
        <div class="wrapper">
            <div class="row">
                <div class="col-sm-12">
                        <section class="panel">
                            <div class="panel-heading">修改新闻</div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-7">

                                        <form class="form-horizontal" id="editorNews" method="post" enctype="multipart/form-data" action="<?php $_PHP_SELF ?>" >

                                            <div class="form-group">
                                                <label for="newsTitle" class="col-sm-2 control-label">新闻标题：</label>
                                                <div class="col-sm-10">
													<?php
														echo "<input name='newsTitle' class='form-control' type='text' id='newsTitle' value=".$project['news_title'] .">";
													?>       
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="newsAuthor" class="col-sm-2 control-label">新闻来源：</label>
                                                <div class="col-sm-10">
													<?php
														echo "<input name='newsAuthor' class='form-control' type='text' id='newsAuthor' value=".$project['news_author'] .">";
													?>  
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="filePic" class="col-sm-2 control-label">缩略图片：</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group">
														<?php
															echo "<input id='docPic' name='docPic' type='text' class='form-control' placeholder='点击浏览选择文件...' value=".$project['news_img'].">";
														?>  
														<span style='position: relative' class='btn btn-primary input-group-addon'>浏览<input id='filePic' name='newsImg' style='width: 60px;height:40px; position: absolute;top:-6px;left: -4px;opacity: 0; filter:alpha(opacity=0)' class='form-control' type='file'></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="newsDescription" class="col-sm-2 control-label">新闻简介：</label>
                                                <div class="col-sm-10">
													<?php
														echo "<textarea name='newsDescription' id='newsDescription' class='form-control' cols='30' rows='3'>".$project['news_description'] ."</textarea>"
													?>  
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="newsContent" class="col-sm-2 control-label">新闻内容：</label>
                                                <div class="col-sm-10">
													<?php
														echo "<script id='newsContent' name='newsContent' type='text/plain'>".$project['news_content']."</script>"
													?> 
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10 ">
                                                    <!--<button type="button" id="add-section" class="btn btn-warning">添加章节</button>-->
                                                    <button type="submit" name="addNews"  class="btn btn-success">提交</button>
                                                    <a  href="news_table.php" class="btn btn-default">返回</a>
                                                </div>
                                            </div>
                                        </form>


                                    </div>
                                    <div class="col-sm-5">
										<?php
											echo "<img src=".$project['news_img'] ." class='img-responsive classPic center-block' alt=''>"
										?>
										<p class="text-center">缩略图</p>
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
    var newsContent;
    $(function() {
        EditableTable.init();
        $("#filePic").change(function () {
            $("#docPic").val($("#filePic").val());
        });
        var ue = UE.getEditor('newsContent', {
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

                    'paragraph', //段落格式
 //                    'simpleupload', //单图上传
//                    'insertimage', //多图上传

                    'searchreplace', //查询替换
                    'justifyleft', //居左对齐
                    'justifyright', //居右对齐
                    'justifycenter', //居中对齐
                    'justifyjustify', //两端对齐

                    'fullscreen', //全屏
                    'insertframe', //插入Iframe

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
            $('#editorNews').submit(function (e) {
                if(ue.hasContents()==false){
                    alert('新闻内容不能为空！');
                    e.preventDefault();
                }else{
                    newsContent = ue.getContent();
                    console.log(newsContent);
                }
            });

        });

    });


</script>
</body>
</html>
<?php
}else{
    echo '<h3>没有获取到编辑ID！</h3>';
}
?>