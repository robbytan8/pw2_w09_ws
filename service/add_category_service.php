<?php

include_once '../entity/Category.php';
include_once '../dao/CategoryDaoImpl.php';
include_once '../util/PDOUtil.php';

$apiKey = filter_input(INPUT_POST, 'api_key');
header("content-type:application/json");
if (isset($apiKey)) {
    $name = filter_input(INPUT_POST, 'name');
    if (isset($name) && !empty($name)) {
        $categoryDao = new CategoryDaoImpl();
        $category = new Category();
        $category->setName($name);
        $categoryDao->addNewCategory($category);
        $jsonData = array();
        $jsonData['status'] = 1;
        $jsonData['message'] = 'Data successfully added';
        echo json_encode($jsonData);
    } else {
        $jsonData = array();
        $jsonData['status'] = 2;
        $jsonData['message'] = 'Name is null';
        echo json_encode($jsonData);
    }
} else {
    $jsonData = array();
    $jsonData['status'] = 2;
    $jsonData['message'] = 'API Key not recognized';
    echo json_encode($jsonData);
}