<?php
session_start();

$email = $_POST['email'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];
$admin = "no";

if($confirm != $password){
    $_SESSION['message']['error'] = '两次密码不一致';
    return header('location: membership.php');
}

//连接数据库
$conn = new mysqli('127.0.0.1', 'root', '', 'wangyizhuo');
// 设置字符集
$conn->set_charset('UTF8');
//准备 sql, 绑定用户参数

//检查帐号是否已经存在
$sql = 'select * from `wangyizhuo_accounts` where user_email = ?';
$statement = $conn->prepare($sql);
//发送请求 缓存结果或者结果集
$statement->bind_param('s', $email);
$statement->execute();
$result = $statement->get_result();

if($result->num_rows > 0){
    $_SESSION['message']['error'] = '用户名已存在';
    return header('location: membership.php');
}

//插入新的帐号信息
$sql = 'insert into `wangyizhuo_accounts` values (null, ?, ?, ?)';
$statement = $conn->prepare($sql);
//发送请求 缓存结果或者结果集
$statement->bind_param('sss', $email, $password, $admin);
$result = $statement->execute();

if($result){
    $_SESSION['message']['success'] = '注册成功，请登录';
    return header('location: login.php');
}else{
    $_SESSION['message']['error'] = '注册失败，请再次尝试';
    return header('location: membership.php');
}
