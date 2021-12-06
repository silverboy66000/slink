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

     $full_name=$_GET['full_name'];
      $username=$_GET['username'];
     $password=$_GET['password'];
      $token=generateRandomString();

    $sql = "INSERT INTO users (full_name, username,password,token) VALUES ('".$full_name."', '".$username."','".$password."','".$token."')";

    if ($conn->query($sql) === TRUE)

    {
        $result = array(
            'full_name' => $full_name,
            'username' => $username,
            'token' => $token,
        );
        new JsonResponse('200', 'کاربری باموفیت ایجاد شد', $result);
    }
    else
    {
//        $result = array(
//            'url' => '',
//            'link' => '',
//            'date' => Carbon::now(),
//        );
//        new JsonResponse('error', 'تولید لینک با خطا مواجه شد لطفا مجدد بررسی نمایید!', $result);
    }
}

function generateRandomString($length = 20) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
