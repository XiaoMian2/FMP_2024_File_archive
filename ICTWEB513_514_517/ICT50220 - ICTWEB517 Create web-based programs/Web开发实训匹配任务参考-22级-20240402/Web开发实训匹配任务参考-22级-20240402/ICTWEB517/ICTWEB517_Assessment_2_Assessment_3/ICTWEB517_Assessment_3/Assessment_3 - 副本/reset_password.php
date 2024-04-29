<?php

session_start();

$old_password = $_POST['old_password'];
$new_password = $_POST['new_password'];
$confirm = $_POST['confirm'];

//原密码校验
if($old_password != $_SESSION['user']['userPassword']){
    $_SESSION['message']['error'] = '您输入的原密码错误';
    return header('location: change_password.php');
}

//两个新密码校验
if($confirm != $new_password){
    $_SESSION['message']['error'] = '两次密码不一致';
    return header('location: change_password.php');
}

//连接数据库
$conn = new mysqli('127.0.0.1', 'root', '', 'wangyizhuo');
// 设置字符集
$conn->set_charset('UTF8');
//准备 sql, 绑定用户参数


//更新数据库中的密码
$sql = 'update `wangyizhuo_accounts` set userPassword = ? where userId = ?';
$statement = $conn->prepare($sql);
//发送请求 缓存结果或者结果集
$statement->bind_param('ss', $new_password, $_SESSION['user']['userId']);
$result = $statement->execute();

if($result){
    $_SESSION['message']['success'] = '更新密码成功';
    return header('location: index.php');
}else{
    $_SESSION['message']['error'] = '更新密码失败，请再次尝试';
    return header('location: change_password.php');
}
