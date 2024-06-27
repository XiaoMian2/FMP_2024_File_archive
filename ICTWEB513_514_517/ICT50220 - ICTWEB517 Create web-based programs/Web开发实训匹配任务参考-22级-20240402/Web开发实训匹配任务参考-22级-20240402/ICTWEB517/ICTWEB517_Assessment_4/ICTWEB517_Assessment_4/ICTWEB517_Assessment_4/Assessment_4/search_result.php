<?php
session_start();

//check5Whether the operation time has expired，Timeout out of login，Reset timer without timeout
if(isset($_SESSION['user']) && !isset($_COOKIE['active_time'])){
    return header('location: logout.php');
}elseif (isset($_SESSION['user']) && isset($_COOKIE['active_time'])){
    setcookie('active_time', time(), time()+300);
}

//If you visit the results page directly without searching，Jump back to search page
if(!isset($_SESSION['search'])){
    $_SESSION['message']['success'] = 'Please enter the product you need to find';
    return header('location: search.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- above3ametalabel*must*at the forefront，Any other content*must*followed！ -->
    <title> wangyizhuo S1554654 - Search Result </title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/global.css">

    <!-- HTML5 shim and Respond.js is to let IE8 support HTML5 elementsandmedia queries（media queries）function -->
    <!-- warning：by file:// agreement（is to directly html Drag and drop the page into the browser）when you accessed the page Respond.js not work -->
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

        <div class="search-result">The query results are as follows</div>
        <div class="row">
            <?php foreach($_SESSION['search']['books'] as $book): ?>
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="thumbnail">
                        <img src="<?php echo $book['image']; ?>" alt="<?php echo $book['book_title']; ?>" class="img-responsive">
                        <div class="caption text-center">
                            <h3><?php echo $book['book_title']; ?></h3>
                            <p>$<?php echo $book['bookPrice']; ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<div class="row">
    <ul class="list-inline text-center">
        <li>wangyizhuo S1554654&nbsp;&nbsp;@</li><li><a href="http://www.fmp.edu.cn/" target="_blank">FUZHOU MELBOURNE POLYTECHNIC</a></li>
    </ul>
</div>


<!-- jQuery (Bootstrap all JavaScript Plug-ins are all dependent jQuery，somustPut it in front) -->
<script src="js/jquery.min.js"></script>
<!-- loaded Bootstrap all JavaScript plug-in。You can also justloadedsingleaplug-in。 -->
<script src="js/bootstrap.min.js"></script>

</body>
</html>
