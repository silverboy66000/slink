<?php
/**
 * Copyright (c) 2021. p.abolfazl.samiei@gmail.com for Saba Idea
 */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/src/MakeLink.php';
require 'db/conncet.php';
require 'config.php';

SabaIdea\MakeLink::CheckValidUrl($_GET['url']); //------ بررسی صحیح بود لینک و یا آدرس اینترنتی
SabaIdea\MakeLink::CheckDuplicateUrl($conn,$_GET['url']); //------ در صورتی که آدرس اینترنتی قبلا ثبت شده باشد آنرا بر میگرداند
SabaIdea\MakeLink::LinkGenerator($conn,$_GET['url']); //------ ایجاد کد یکتای لینک و ذخیره در دیتابیس
