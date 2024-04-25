<?php

session_start();

$keyword = $_POST['keyword'];

//连接数据库
$conn = new mysqli('127.0.0.1', 'root', '', 'WangYiZhuo');
// 设置字符集
$conn->set_charset('UTF8');
//准备 sql, 绑定用户参数

//往查询记录存储表中添加查询关键字记录
$sql = 'insert into `WangYiZhuo_tracking` values(null, ?)';
$statement = $conn->prepare($sql);
$statement->bind_param('s', $keyword);
$statement->execute();

//模糊查询，检查是否有查询关键字相关数据
$sql = 'select * from `WangYiZhuo_products` where bookTitle like ?';
$statement = $conn->prepare($sql);
//发送请求 缓存结果或者结果集
$keyword_param = '%'.$keyword.'%';
$statement->bind_param('s', $keyword_param);
$statement->execute();
$result = $statement->get_result();

//重置 session中的查询数据
unset($_SESSION['search']);

//判断是否有数据
if ($result->num_rows == 0) {
    //无数据返回查询页面
    $_SESSION['message']['success'] = '未找到任何相关书籍记录';
    return header('location: search.php');
} else {
    //有数据，将数据存入session跳转至结果页面
    while ($book = $result->fetch_assoc()){
        $_SESSION['search']['books'][] = $book;
    }
    return header('location: search_result.php');
}
