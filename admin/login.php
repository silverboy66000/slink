<?php
/**
 * Copyright (c) 2021. p.abolfazl.samiei@gmail.com for Saba Idea
 */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../db/conncet.php';
require __DIR__ . '/../config.php';

use Carbon\Carbon;
use Devscreencast\ResponseClass\JsonResponse;


if (isset($_GET))
{

    $username=$_GET['username'];
    $password=$_GET['password'];

    $query = "SELECT * FROM users WHERE username = '".$username."' ";
    $result = $conn->query($query);
    if ($result->num_rows > 0)
    {
        $row = $result->fetch_assoc();
        $result = array(
            'full_name' => $row['full_name'],
            'username' => $row['username'],
            'token' => $row['token'],
        );
        new JsonResponse('200', 'ورود با موفقیت انجام شد', $result);
        exit();

    }
    else
    {
        return true;
    }
}



