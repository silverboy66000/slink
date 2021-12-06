<?php
/**
 * Copyright (c) 2021. p.abolfazl.samiei@gmail.com for Saba Idea
 */

//----- Require Methods
require __DIR__ . '/db.php';
use Devscreencast\ResponseClass\JsonResponse;

//----- Try Connect to DataBase
$conn = new mysqli($config['server'], $config['username'], $config['password'], $config['database']);
if ($conn->connect_error)
{
    $result = array(
        'url' => '',
        'link' => '',
        'date' => '',
    );
    new JsonResponse('error', 'دسترسی به دیتابیس امکان پذیر نمیباشد.', $result);
    exit();
}