<?php

include_once '../entity/User.php';
include_once '../entity/Role.php';
include_once '../dao/UserDaoImpl.php';
include_once '../util/PDOUtil.php';

$apiKey = filter_input(INPUT_POST, 'api_key');
header("content-type:application/json");
if (isset($apiKey)) {
    $email = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'password');
    if (isset($email) && isset($password) && !empty($email) && !empty($password)) {
        $user = new User();
        $user->setEmail($email);
        $user->setPassword($password);
        $userDao = new UserDaoImpl();
        $result = $userDao->login($user);
        echo json_encode($result);
    } else {
        $jsonData = array();
        $jsonData['status'] = 2;
        $jsonData['message'] = 'Missing email or password';
        echo json_encode($jsonData);
    }
} else {
    $jsonData = array();
    $jsonData['status'] = 2;
    $jsonData['message'] = 'API Key not recognized';
    echo json_encode($jsonData);
}