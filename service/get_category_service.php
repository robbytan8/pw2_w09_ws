<?php

include_once '../entity/Category.php';
include_once '../dao/CategoryDaoImpl.php';
include_once '../util/PDOUtil.php';

$apiKey = filter_input(INPUT_POST, 'api_key');
header("content-type:application/json");
if (isset($apiKey)) {
    $id = filter_input(INPUT_POST, 'id');
    if (isset($id) && !empty($id)) {
        $categoryDao = new CategoryDaoImpl();
        $result = $categoryDao->getCategoryFromDb($id);
        echo json_encode($result);
    } else {
        $jsonData = array();
        $jsonData['status'] = 2;
        $jsonData['message'] = 'Data not found';
        echo json_encode($jsonData);
    }
} else {
    $jsonData = array();
    $jsonData['status'] = 2;
    $jsonData['message'] = 'API Key not recognized';
    echo json_encode($jsonData);
}