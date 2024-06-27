<?php

session_start();

$old_password = $_POST['old_password'];
$new_password = $_POST['new_password'];
$confirm = $_POST['confirm'];

//Original password verification
if($old_password != $_SESSION['user']['userPassword']){
    $_SESSION['message']['error'] = 'The original password you entered is wrong';
    return header('location: change_password.php');
}

//Two new password verification
if($confirm != $new_password){
    $_SESSION['message']['error'] = 'The passwords are inconsistent twice';
    return header('location: change_password.php');
}

//connect to the database
$conn = new mysqli('127.0.0.1', 'root', '', 'wangyizhuo');
// Set character set
$conn->set_charset('UTF8');
//ready sql, Binding user parameters


//Update passwords in database
$sql = 'update `wangyizhuo_accounts` set userPassword = ? where userId = ?';
$statement = $conn->prepare($sql);
//send a request Cache results or result sets
$statement->bind_param('ss', $new_password, $_SESSION['user']['userId']);
$result = $statement->execute();

if($result){
    $_SESSION['message']['success'] = 'Password updated successfully';
    return header('location: index.php');
}else{
    $_SESSION['message']['error'] = 'Failed to update password，please try again';
    return header('location: change_password.php');
}
