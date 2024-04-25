<?php

session_start();

//检查是否登录，如果未登录则前往登录页面进行登录
if(!isset($_SESSION['user'])){
    $_SESSION['message']['error'] = '您还未登录, 请先登录';
    return header('location: login.php');
}

//检查是否是admin登录，如果不是则前往主页面提示无权查看
if(isset($_SESSION['user']) && $_SESSION['user']['is_admin'] != 'yes'){
    $_SESSION['message']['success'] = '您无权访问该服务';
    return header('location: index.php');
}

//检查5分无操作时间是否超时，超时注销登录，未超时重置计时器
if(!isset($_COOKIE['active_time'])){
    return header('location: logout.php');
}elseif (isset($_COOKIE['active_time'])){
    setcookie('active_time', time(), time()+300);
}

//连接数据库
$conn = new mysqli('127.0.0.1', 'root', '', 'WangYiZhuo');
// 设置字符集
$conn->set_charset('UTF8');
//准备 sql, 绑定用户参数

//查询所有的用户搜索关键字数据，按照关键字分组并统计数据
$sql = 'select data, count(data) as total from WangYiZhuo_tracking group by data order by total desc';
$statement = $conn->prepare($sql);
//发送请求 缓存结果或者结果集
$statement->execute();
$result = $statement->get_result();

while ($keyword = $result->fetch_assoc()){
    $keywords[] = $keyword;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title> WangYiZhuo S1554654 - Hot </title>

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


<?php if(isset($_SESSION['message']['success'])): ?>
    <div class="text-center alert alert-success">
        <?php echo $_SESSION['message']['success'];  unset($_SESSION['message']['success']); ?>
    </div>
<?php endif; ?>

<div class="jumbotron">
    <div class="container">
        <div id="keywords">
            <h2>热门查询</h2>

            <div id="keyword_list">
                <?php if(isset($keywords)): ?>
                    <?php foreach ($keywords as $keyword): ?>
                        <a class="keyword" href="search.php?kw=<?php echo $keyword['data']; ?>"><?php echo $keyword['data']; ?></a>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="alert-success">暂无热搜词条</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <ul class="list-inline text-center">
        <li>WangYiZhuo S1554654&nbsp;&nbsp;@</li><li><a href="http://www.fmp.edu.cn/" target="_blank">FUZHOU MELBOURNE POLYTECHNIC</a></li>
    </ul>
</div>


<!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
<script src="js/jquery.min.js"></script>
<!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
<script src="js/bootstrap.min.js"></script>

</body>
</html>
