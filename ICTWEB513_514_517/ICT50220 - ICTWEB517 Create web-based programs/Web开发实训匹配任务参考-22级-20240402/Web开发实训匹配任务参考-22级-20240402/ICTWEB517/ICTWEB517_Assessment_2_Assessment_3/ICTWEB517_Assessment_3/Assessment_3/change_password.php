<?php
session_start();

//Check whether you are logged in. If not, go to the login page to log in.
if(!isset($_SESSION['user'])){
    $_SESSION['message']['error'] = 'you are not logged in, if you signed in';
    return header('location: login.php');
}

//Check whether the 5-minute inactivity time has timed out, log out and log in after the timeout, and reset the timer if it has not timed out.
if(!isset($_COOKIE['active_time'])){
    return header('location: logout.php');
}elseif (isset($_COOKIE['active_time'])){
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
    <title> wangyizhuo S1554654 - Change Password </title>

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


<div class="jumbotron">
    <div class="container">
        <div class="row">
            <div class="hidden-xs col-sm-4 col-md-4 col-lg-4">
                <div class="thumbnail">
                    <img src="images/reset_password.jpeg" alt="reset your password">
                </div>
            </div>
            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                <h1 class="text-center">Change Password</h1>
                <form class="form-horizontal" action="reset_password.php" method="post">
                    <div class="form-group">
                        <label for="inputOldPassdowrd3" class="col-sm-2 control-label">Old Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="inputOldPassdowrd3" name="old_password" placeholder="Old Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputNewPassword3" class="col-sm-2 control-label">New Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="inputNewPassword3" name="new_password" placeholder="New Password">
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
                            <button type="submit" class="btn btn-default btn-block">Confirm</button>
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
        <li> wangyizhuo S1554654 &nbsp;&nbsp;@</li><li><a href="http://www.fmp.edu.cn/" target="_blank">FUZHOU MELBOURNE POLYTECHNIC</a></li>
    </ul>
</div>


<!-- jQuery (all JavaScript plug-ins of Bootstrap depend on jQuery, so they must be placed first) -->
<script src="js/jquery.min.js"></script>
<!-- Load all JavaScript plugins for Bootstrap. You can also load just a single plugin if needed. -->
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

