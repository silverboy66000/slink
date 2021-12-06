<?php
/**
 * Copyright (c) 2021. p.abolfazl.samiei@gmail.com for Saba Idea
 */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/links/LinkContoller.php';
require __DIR__ . '/users/CheckToken.php';
require __DIR__ . '/../db/conncet.php';
require __DIR__ . '/../config.php';
use Carbon\Carbon;
use Devscreencast\ResponseClass\JsonResponse;


if (SabaIdeaAdmin\CheckToken::checkHeaderToken())
{
    $userEditLink=new SabaIdeaAdmin\LinkContoller();
    $userEditLink->LinkDeleter($conn,SabaIdeaAdmin\CheckToken::checkHeaderToken($conn));
}
else
{
    $result = array(
        'name' => null,
        'username' => null,
        'token' => null,
    );
    new JsonResponse('error', 'لطفا وارد پنل کاربری شوید.', $result);

}



