<?php

session_start();

$keyword = $_POST['keyword'];

//connect to the database
$conn = new mysqli('127.0.0.1', 'root', '', 'wangyizhuo');
// Set character set
$conn->set_charset('UTF8');
//ready sql, Binding user parameters

//Add query keyword records to the query record storage table
$sql = 'insert into `wangyizhuo_tracking` values(null, ?)';
$statement = $conn->prepare($sql);
$statement->bind_param('s', $keyword);
$statement->execute();

//fuzzy query，Check whether there is data related to query keywords
$sql = 'select * from `wangyizhuo_products` where book_title like ?';
$statement = $conn->prepare($sql);
//send a request Cache results or result sets
$keyword_param = '%'.$keyword.'%';
$statement->bind_param('s', $keyword_param);
$statement->execute();
$result = $statement->get_result();

//reset sessionQuery data in
unset($_SESSION['search']);

//Determine whether there is data
if ($result->num_rows == 0) {
    //No data return to the query page
    $_SESSION['message']['success'] = 'No relevant book records were found';
    return header('location: search.php');
} else {
    //there are data，store data insessionSkip to results page
    while ($book = $result->fetch_assoc()){
        $_SESSION['search']['books'][] = $book;
    }
    return header('location: search_result.php');
}
