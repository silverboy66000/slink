<?php
namespace SabaIdeaAdmin;

use Devscreencast\ResponseClass\JsonResponse;

class CheckToken
{
    public static function checkHeaderToken($conn)
    {
        $headers = apache_request_headers();
        $UserToken=null;
        foreach ($headers as $header => $value)
        {
            if ($header=='Authorization')
            {
                if (!empty($value)) {
                    if (preg_match('/Bearer\s(\S+)/', $value, $matches)) {
                        $UserToken=$matches[1];
                    }
                }
            }
        }

        $query = "SELECT * FROM users WHERE token = '".$UserToken."' ";
        $result = $conn->query($query);
        if ($result->num_rows > 0)
        {
            $row = $result->fetch_assoc();
            return $row['id'] ;
        }
        else
        {
            return null;
        }

    }
}

