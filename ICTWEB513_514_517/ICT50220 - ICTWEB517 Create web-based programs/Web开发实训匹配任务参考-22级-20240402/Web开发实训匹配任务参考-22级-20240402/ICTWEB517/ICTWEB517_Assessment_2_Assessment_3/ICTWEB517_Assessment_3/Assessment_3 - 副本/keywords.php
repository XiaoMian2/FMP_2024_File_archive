<?php

session_start();

//Check whether you are logged in. If not, go to the login page to log in.
if(!isset($_SESSION['user'])){
    $_SESSION['message']['error'] = '您还未登录, 请先登录';
    return header('location: login.php');
}

//Check whether you are logged in as admin. If not, go to the main page and prompt that you have no permission to view it.
if(isset($_SESSION['user']) && $_SESSION['user']['is_admin'] != 'yes'){
    $_SESSION['message']['success'] = '您无权访问该服务';
    return header('location: index.php');
}

//Check whether the 5-minute inactivity time has timed out, log out and log in after the timeout, and reset the timer if it has not timed out.
if(!isset($_COOKIE['active_time'])){
    return header('location: logout.php');
}elseif (isset($_COOKIE['active_time'])){
    setcookie('active_time', time(), time()+300);
}

//Connect to the database
$conn = new mysqli('127.0.0.1', 'root', '', 'wangyizhuo');
// 设Set character set
$conn->set_charset('UTF8');
//Prepare sql, bind user parameters

//Query all user search keyword data, group by keyword and collect statistics
$sql = 'select tracking_data, count(tracking_data) as total from wangyizhuo_tracking group by tracking_data order by total desc';
$statement = $conn->prepare($sql);
//Send a request and cache the result or result set
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
    <!-- The above 3 meta tags *must* be placed first, and any other content *must* follow them! -->
    <title> wangyizhuo S1554654 - Hot </title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/global.css">

    <!-- HTML5 shim and Respond.js are for IE8 to support HTML5 elements and media queries -->
    <!-- Warning: Respond.js does not work when accessing the page through the file:// protocol (that is, dragging the html page directly into the browser) -->
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
                <form action="process_searching.php" method="post" class="navbar-form navbar-left">
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
                        <a class="keyword" href="search.php?kw=<?php echo $keyword['tracking_data']; ?>"><?php echo $keyword['tracking_data']; ?></a>
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
        <li>wangyizhuo S1554654&nbsp;&nbsp;@</li><li><a href="http://www.fmp.edu.cn/" target="_blank">FUZHOU MELBOURNE POLYTECHNIC</a></li>
    </ul>
</div>


<!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
<script src="js/jquery.min.js"></script>
<!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
<script src="js/bootstrap.min.js"></script>

</body>
</html>
