<?php

include_once '../entity/Book.php';
include_once '../entity/Category.php';
include_once '../dao/BookDaoImpl.php';
include_once '../util/PDOUtil.php';

$apiKey = filter_input(INPUT_GET, 'api_key');
header("content-type:application/json");
if (isset($apiKey)) {
    $categoryDao = new BookDaoImpl();
    $result = $categoryDao->getAllBooks();
    $categories = array();
    /* @var $category Book */
    foreach ($result as $category) {
        array_push($categories, $category);
    }
    echo json_encode($categories);
} else {
    $jsonData = array();
    $jsonData['status'] = 2;
    $jsonData['message'] = 'API Key not recognized';
    echo json_encode($jsonData);
}