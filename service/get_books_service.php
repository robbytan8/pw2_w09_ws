<?php

include_once '../entity/Book.php';
include_once '../entity/Category.php';
include_once '../dao/BookDaoImpl.php';
include_once '../util/PDOUtil.php';

$apiKey = filter_input(INPUT_GET, 'api_key');
header("content-type:application/json");
if (isset($apiKey)) {
    $bookDao = new BookDaoImpl();
    $result = $bookDao->getAllBooks();
    $books = array();
    /* @var $book Book */
    foreach ($result as $book) {
        array_push($books, $book);
    }
    echo json_encode($books);
} else {
    $jsonData = array();
    $jsonData['status'] = 2;
    $jsonData['message'] = 'API Key not recognized';
    echo json_encode($jsonData);
}