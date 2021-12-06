<?php
namespace SabaIdea;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use Carbon\Carbon;
use Devscreencast\ResponseClass\JsonResponse;
use SabaIdeaAdmin\CheckToken;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../db/conncet.php';
require __DIR__ . '/../config.php';

class MakeLink
{
    function __construct()
    {
        $this->timestamp = Carbon::now('Y-m-d H:i:s');
    }

    //---- بررسی صحت آدرس اینترنتی
    public static function CheckValidUrl($url=null)
    {
        if (filter_var($url, FILTER_VALIDATE_URL) === FALSE) {
            $result = array(
                'url' => $url,
                'link' => null,
                'date' => Carbon::now(),
            );
            new JsonResponse('error', 'آدرس معتبر نمیباشد!', $result);
            exit();
        }
        else
        {
            return true;
        }
    }

    //----- بررسی تکراری بودن آدرس اینترنتی
    public static function CheckDuplicateUrl($conn,$url=null)
    {
        $query = "SELECT * FROM links WHERE url = '".$url."' ";
        $result = $conn->query($query);
        if ($result->num_rows > 0)
        {
            $row = $result->fetch_assoc();
            $result = array(
                'url' => $row['url'],
                'link' => base_url.'/'.$row['string'],
                'date' => $row['created_at'],
            );
            new JsonResponse('success', 'آدرس قبلا ثبت شده بود.', $result);
            exit();

        }
        else
        {
            return true;
        }

    }

    //----- ساخت کد کوتاه کننده
    public static function LinkGenerator($conn,$url=null)
    {
        $length=length;
        $stringChar = char;
        $stringLength = strlen($stringChar);
        $randomString = "";

        for ($i=0; $i<$length; $i++)
        {
            $randomString .= $stringChar[rand(0, $stringLength-1)];
        }

        $query = "SELECT * FROM links WHERE string = '".$randomString."' ";
        $result = $conn->query($query);
        if ($result->num_rows > 0)
        {
            die($randomString);
        }
        else
        {
            self::InsertLink($conn,$url,$randomString);
        }

    }

    //----- ذخیره کد در دیتابیس و نمایش به کاربر
    public static function InsertLink($conn,$url=null,$string=null)
    {
        require __DIR__ . '/../admin/users/CheckToken.php';
        require __DIR__ . '/../admin/users/UserProfile.php';

        $token=new CheckToken();
        $user_id=$token->checkHeaderToken();
        $sql = "INSERT INTO links (url, string,user_id) VALUES ('".$url."', '".$string."','".$user_id."')";

        if ($conn->query($sql) === TRUE)

        {
            $result = array(
                'url' => $url,
                'link' => base_url.'/'.$string,
                'date' => Carbon::now(),
            );
            new JsonResponse('200', 'لینک کوتاه با موفقیت ایجاد گردید.', $result);
        }
        else
        {
            $result = array(
                'url' => '',
                'link' => '',
                'date' => Carbon::now(),
            );
            new JsonResponse('error', 'تولید لینک با خطا مواجه شد لطفا مجدد بررسی نمایید!', $result);
        }

    }

}