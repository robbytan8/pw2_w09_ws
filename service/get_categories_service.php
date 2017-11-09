<?php

include_once '../entity/Category.php';
include_once '../dao/CategoryDaoImpl.php';
include_once '../util/PDOUtil.php';

$apiKey = filter_input(INPUT_GET, 'api_key');
header("content-type:application/json");
if (isset($apiKey)) {
    $categoryDao = new CategoryDaoImpl();
    $result = $categoryDao->getAllCategories();
    $categories = array();
    /* @var $category Category */
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