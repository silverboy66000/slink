<?php
namespace SabaIdeaAdmin;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/../../vendor/autoload.php';
use Carbon\Carbon;
use Devscreencast\ResponseClass\JsonResponse;

class UserProfile
{

    public function UserProfile($conn,$user_id=null)
    {
        $Linkrows=null;
        if (isset($_GET))
        {

            $query = "SELECT * FROM links WHERE user_id = '".$user_id."' ";
            $result = $conn->query($query);
            if ($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc()) {
                    $Linkrows[]=$result->fetch_assoc();
                }
            }
            $query = "SELECT * FROM users WHERE id = '".$user_id."' ";
            $result = $conn->query($query);
            if ($result->num_rows > 0)
            {
                $row = $result->fetch_assoc();
                $result = array(
                    array(
                        'userInfo' =>
                            array(
                            'full_name' => $row['full_name'],
                            'username' => $row['username'],
                        ),
                        'userLinks' =>$Linkrows,
                    ),

                );
                new JsonResponse('200', 'به پنل مدیریت خوش آمدید!', $result);
                exit();
            }
            else
            {
                return true;
            }



        }

    }
}
