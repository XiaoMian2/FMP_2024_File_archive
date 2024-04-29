<?php

session_start();

$email = $_POST['email'];
$password = $_POST['password'];

//连接数据库
$conn = new mysqli('127.0.0.1', 'root', '', 'wangyizhuo');
// 设置字符集
$conn->set_charset('UTF8');
//准备 sql, 绑定用户参数

//查询用户名和密码是否在数据库里accounts存在
$sql = 'select * from `wangyizhuo_accounts` where user_email = ? and userPassword = ?';
$statement = $conn->prepare($sql);
//发送请求 缓存结果或者结果集
$statement->bind_param('ss', $email, $password);
$statement->execute();
$result = $statement->get_result();

if($result->num_rows != 1) {

    //不存在数据，则登录失败 返回登录页面
    $_SESSION['message']['error'] = '用户或者密码错误';
    return header('location: login.php');
}else{

    //登录成功，记录用户数据
    $user = $result->fetch_assoc();
    if($user['is_admin'] == 'yes'){
        $_SESSION['message']['success'] = '欢迎回来，管理员，'.$user['user_email'];
    }else{
        $_SESSION['message']['success'] = '欢迎回来，尊贵的会员，'.$user['user_email'];
    }
    $_SESSION['user'] = $user;

    //登录后设置5分钟无操作 cookie, 返回主页
    setcookie('active_time', time(), time()+300);
    return header('location: index.php');
}
