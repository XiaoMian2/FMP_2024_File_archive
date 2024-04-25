<?php
session_start();

//如果已经登录，则不允许继续访问登录
if(isset($_SESSION['user'])){
    $_SESSION['message']['success'] = '欢迎回来, '.$_SESSION['user']['user_email'];
    return header('location: index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title> WangYiZhuo S1554654 - Membership </title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/global.css">

    <!-- HTML5 shim 和 Respond.js 是为了让 IE8 支持 HTML5 元素和媒体查询（media queries）功能 -->
    <!-- 警告：通过 file:// 协议（就是直接将 html 页面拖拽到浏览器中）访问页面时 Respond.js 不起作用 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.jsdelivr.cn/npm/html5shiv@3.7.3/dist/html5shiv.min.js"></script>
    <script src="https://cdn.jsdelivr.cn/npm/respond.js@1.4.2/dest/respond.min.js"></script>
    <![endif]-->
</head>
<body>


<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">
                    <img alt="Brand" src="images/brand.jpeg">
                </a>
            </div>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-left">
                <li><a href="index.php">Home</a></li>
                <li><a href="about_us.php">About Us</a></li>
                <li><a href="contact_us.php">Contact Us</a></li>

                <?php if(isset($_SESSION['user'])): ?>
                    <li><a href="search.php">Search</a></li>
                    <?php if(isset($_SESSION['user']) && $_SESSION['user']['is_admin'] == 'yes'): ?>
                        <li><a href="keywords.php">Hot</a></li>
                    <?php endif; ?>
                    <li><a href="change_password.php">Change Password</a></li>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="membership.php">Membership</a></li>
                    <li><a href="login.php">Login</a></li>
                <?php endif; ?>
            </ul>
            <?php if(isset($_SESSION['user'])): ?>
                <form action="process_searching.php" method="post" class="navbar-form navbar-right">
                    <div class="form-group">
                        <input type="text" class="form-control" name="keyword" placeholder="Book Title">
                    </div>
                    <button type="submit" class="btn btn-default">Go</button>
                </form>
            <?php endif; ?>
        
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>


<div class="jumbotron">
    <div class="container">
        <div class="row">
            <div class="hidden-xs col-sm-4 col-md-4 col-lg-4">
                <div class="thumbnail">
                    <img src="images/free_membership.jpeg" alt="免费会员">
                </div>
            </div>
            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                <h1 class="text-center">Join Us For Free</h1>
                <form class="form-horizontal" action="register_user.php" method="post">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="inputEmail3" name="email" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="inputPassword3" name="password" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputConfirm3" class="col-sm-2 control-label">Confirm</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="inputConfirm3" name="confirm" placeholder="Confirm Password">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary btn-block">Join Us</button>
                        </div>
                    </div>

                    <?php if(isset($_SESSION['message']['error'])): ?>
                        <div class="text-center alert alert-danger col-sm-offset-2 col-sm-10">
                            <?php echo $_SESSION['message']['error']; unset($_SESSION['message']['error']); ?>
                        </div>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</div>
    <div class="row">
    <ul class="list-inline text-center">
        <li> WangYiZhuo S1554654 &nbsp;&nbsp;@</li><li><a href="http://www.fmp.edu.cn/" target="_blank">FUZHOU MELBOURNE POLYTECHNIC</a></li>
    </ul>
</div>


<!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
<script src="js/jquery.min.js"></script>
<!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
<script src="js/bootstrap.min.js"></script>

<script>

    $(function () {
        $("div.thumbnail > img").mouseenter(function () {
            $(this).parent().animate({
                width:"120%"
            }, 100)
        })

        $("div.thumbnail > img").mouseleave(function () {
            $(this).parent().animate({
                width:"100%"
            }, 100)
        })
    })

</script>

</body>
</html>

