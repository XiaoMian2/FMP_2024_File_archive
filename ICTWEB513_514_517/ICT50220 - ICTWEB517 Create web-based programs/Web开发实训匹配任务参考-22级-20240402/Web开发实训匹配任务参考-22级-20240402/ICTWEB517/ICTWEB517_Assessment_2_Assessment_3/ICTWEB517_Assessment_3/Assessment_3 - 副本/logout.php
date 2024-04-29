<?php

session_start();

//清理数据，注销登录，返回登录页面
$_SESSION = array();
session_destroy();
setcookie(session_name(), '', -1, '/');
setcookie('active_time', '', -1, '/');

header('location: login.php');
