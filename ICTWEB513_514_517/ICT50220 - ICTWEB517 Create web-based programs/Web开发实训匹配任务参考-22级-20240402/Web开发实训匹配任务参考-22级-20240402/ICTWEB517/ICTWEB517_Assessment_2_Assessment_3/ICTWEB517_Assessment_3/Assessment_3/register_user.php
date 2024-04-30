<?php
session_start();

$email = $_POST['email'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];
$admin = "no";

if($confirm != $password){
    $_SESSION['message']['error'] = 'The passwords are inconsistent twice';
    return header('location: membership.php');
}

//connect to the database
$conn = new mysqli('127.0.0.1', 'root', '', 'wangyizhuo');
// Set character set
$conn->set_charset('UTF8');
//ready sql, Binding user parameters

//Check whether the account already exists
$sql = 'select * from `wangyizhuo_accounts` where user_email = ?';
$statement = $conn->prepare($sql);
//send a request Cache results or result sets
$statement->bind_param('s', $email);
$statement->execute();
$result = $statement->get_result();

if($result->num_rows > 0){
    $_SESSION['message']['error'] = 'user name already exists';
    return header('location: membership.php');
}

//Insert new account information
$sql = 'insert into `wangyizhuo_accounts` values (null, ?, ?, ?)';
$statement = $conn->prepare($sql);
//send a request Cache results or result sets
$statement->bind_param('sss', $email, $password, $admin);
$result = $statement->execute();

if($result){
    $_SESSION['message']['success'] = 'Registration is successful，please log in';
    return header('location: login.php');
}else{
    $_SESSION['message']['error'] = 'Registration failure，please try again';
    return header('location: membership.php');
}
