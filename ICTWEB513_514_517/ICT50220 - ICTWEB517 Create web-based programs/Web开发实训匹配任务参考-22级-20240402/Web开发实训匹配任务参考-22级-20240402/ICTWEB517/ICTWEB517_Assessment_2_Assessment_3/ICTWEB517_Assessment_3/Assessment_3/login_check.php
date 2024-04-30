<?php

session_start();

$email = $_POST['email'];
$password = $_POST['password'];

//connect to the database
$conn = new mysqli('127.0.0.1', 'root', '', 'wangyizhuo');
// Set character set
$conn->set_charset('UTF8');
//ready sql, Binding user parameters

//Check whether the user name and password are in the databaseaccountspresence
$sql = 'select * from `wangyizhuo_accounts` where user_email = ? and userPassword = ?';
$statement = $conn->prepare($sql);
//send a request Cache results or result sets
$statement->bind_param('ss', $email, $password);
$statement->execute();
$result = $statement->get_result();

if($result->num_rows != 1) {

    //notpresencedata，Login fails Return to login page
    $_SESSION['message']['error'] = 'Wrong user or password';
    return header('location: login.php');
}else{

    //login is successful，recording user data
    $user = $result->fetch_assoc();
    if($user['is_admin'] == 'yes'){
        $_SESSION['message']['success'] = 'welcome back，administrator，'.$user['user_email'];
    }else{
        $_SESSION['message']['success'] = 'welcome back，Distinguished member，'.$user['user_email'];
    }
    $_SESSION['user'] = $user;

    //Settings after login5No operation in minutes cookie, return to the home page
    setcookie('active_time', time(), time()+300);
    return header('location: index.php');
}
