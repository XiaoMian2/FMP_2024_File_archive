<?php

session_start();

//cleaning data，Log out，Return to login page
$_SESSION = array();
session_destroy();
setcookie(session_name(), '', -1, '/');
setcookie('active_time', '', -1, '/');

header('location: login.php');
