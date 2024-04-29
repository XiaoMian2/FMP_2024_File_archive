<?php
session_start();

//Check whether the 5-minute inactivity time has timed out, log out and log in after the timeout, and reset the timer if it has not timed out.
if(isset($_SESSION['user']) && !isset($_COOKIE['active_time'])){
    return header('location: logout.php');
}elseif (isset($_SESSION['user']) && isset($_COOKIE['active_time'])){
    setcookie('active_time', time(), time()+300);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* be placed first, and any other content *must* follow them! -->
    <title> wangyizhuo S1554654 - Home </title>

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
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src="images/category_1.jpeg" alt="分类1说明">
                    <div class="carousel-caption">
                        书籍分类1简介
                    </div>
                </div>
                <div class="item">
                    <img src="images/category_2.jpeg" alt="分类2说明">
                    <div class="carousel-caption">
                        书籍分类2简介
                    </div>
                </div>
                <div class="item">
                    <img src="images/category_3.jpeg" alt="分类3说明">
                    <div class="carousel-caption">
                        书籍分类3简介
                    </div>
                </div>
            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>


<div class="row">
    <ul class="list-inline text-center">
        <li>wangyizhuo S1554654&nbsp;&nbsp;@</li><li><a href="http://www.fmp.edu.cn/" target="_blank">FUZHOU MELBOURNE POLYTECHNIC</a></li>
    </ul>
</div>


<!-- jQuery (all JavaScript plug-ins of Bootstrap depend on jQuery, so they must be placed first) -->
<script src="js/jquery.min.js"></script>
<!-- Load all JavaScript plugins for Bootstrap. You can also load just a single plugin if needed. -->
<script src="js/bootstrap.min.js"></script>

</body>
</html>
