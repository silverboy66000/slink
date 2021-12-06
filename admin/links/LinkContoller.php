<?php
namespace SabaIdeaAdmin;
use Carbon\Carbon;
use Devscreencast\ResponseClass\JsonResponse;
class LinkContoller
{
    public function LinkEditor($conn,$user_id=null)
    {
        $url=$_GET['url'];
        $id=$_GET['id'];

        $sql = "UPDATE links SET url='".$url."' WHERE id=$id and user_id=$user_id";
        if ($conn->query($sql) === TRUE)
        {
            $query = "SELECT * FROM links WHERE id = '".$id."' ";
            $result = $conn->query($query);
            if ($result->num_rows > 0)
            {
                $row = $result->fetch_assoc();
                    $link=$row['string'];

            }

            $result = array(
                'url' => $url,
                'link' => base_url.'/'.$link,
                'date' => Carbon::now(),
            );
            new JsonResponse('200', 'ویرایش با موفقیت انجام گردید!', $result);
        }
        else
        {
        $result = array(
            'url' => '',
            'link' => '',
            'date' => Carbon::now(),
        );
        new JsonResponse('error', 'شناسه لینک با مشخصات کاربری یکی نمیباشد', $result);
        }
    }
    public function LinkDeleter($conn,$user_id=null)
    {
        $id=$_GET['id'];

        $sql = "DELETE FROM links WHERE id='".$id."' and user_id='".$user_id."'";
        if ($conn->query($sql) === TRUE)
        {
            $result = array(
                'url' => null,
                'link' => null,
                'date' => null,
            );
            new JsonResponse('200', 'حذف با موفقیت انجام گردید!', $result);
        }
        else
        {
        $result = array(
            'url' => '',
            'link' => '',
            'date' => Carbon::now(),
        );
        new JsonResponse('error', 'شناسه لینک با مشخصات کاربری یکی نمیباشد', $result);
        }
    }
}
