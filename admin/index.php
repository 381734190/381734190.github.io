<?php
session_start();
header('conten-type:text/html;charset=utf-8');
//注销登录
if($_GET['action'] == "logout"){
    unset($_SESSION['admin_name']);
	echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
    echo "<script type='text/javascript'>alert('注销成功!');</script>";
	echo "<script type='text/javascript'>window.location.href='index.php'</script>";
    exit;
}


if (isset($_POST['login'])) {
    require 'db.php';

    mysql_select_db( 'bdm273381634_db',$conn);

    $admin_name = $_POST['name'];
    $admin_pwd = $_POST['pwd'];

    if(preg_match('/^[a-zA-Z][a-zA-Z0-9]{4,12}$/',$admin_name)){
        $check_query = mysql_query("select * from web_admin where admin_name='$admin_name' and admin_pwd='$admin_pwd' 
        limit 1");
        if($result = mysql_fetch_array($check_query)){
            //登录成功
            $_SESSION['admin_name'] = $admin_name;
            echo "<script type='text/javascript'>alert('登陆成功!');</script>";
            echo "<script type='text/javascript'>window.location.href='main.php'</script>";
        } else {
            echo "<script type='text/javascript'>alert('登陆失败，请重试!');</script>";
        }
    }else{
        echo "<script type='text/javascript'>alert('请输入合法用户名!');</script>";
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
    <title>登录--后台管理中心</title>

    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

<body class="login-body">

<div class="container">

    <form class="form-signin" method="post" action="<?php $_PHP_SELF ?>">
        <div class="form-signin-heading text-center">
            <h1 class="sign-title">登录后台</h1>
            <img src="images/login-logo.png" alt=""/>
        </div>
        <div class="login-wrap">
            <input type="text" class="form-control" name="name" id="name" placeholder="用户名" autofocus>
            <input type="password" class="form-control" name="pwd" id="pwd" placeholder="密码">

            <button class="btn btn-lg btn-login btn-block" id="login" name="login" type="submit">
                <i class="fa fa-check"></i>
            </button>

            <div class="registration">
                非网站管理员，请勿随意登陆。
            </div>

        </div>

    </form>

</div>



<!-- Placed js at the end of the document so the pages load faster -->

<!-- Placed js at the end of the document so the pages load faster -->
<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/modernizr.min.js"></script>

</body>
</html>
