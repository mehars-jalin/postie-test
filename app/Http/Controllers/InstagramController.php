<?php

namespace App\Http\Controllers;

use App\UserMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Intervention\Image\Facades\Image;
use Mockery\Exception;
use Vinkla\Instagram\Instagram;

class InstagramController extends Controller
{

    private $instagram;

    const COMMENT_POINTS    =   5;
    const LIKE_POINTS       =   1;
    const TOTAL_POSTS       =   6;
    const IMAGE_HEIGHT      =   600;
    const IMAGE_WIDTH       =   600;

    public function fetchInstaData($access_token){

        $this->instagram    =   new Instagram($access_token);

        $images             =   $this->instagram->media();

        $data                         =     new \stdClass();
        $data->user_data              =     new \stdClass();
        $data->user_data->full_name   =     $images[0]->user->full_name;
        $data->user_data->user_name   =     $images[0]->user->username;

        $images                       =     collect($images);
        $data->image_data             =     $images->transform(function($image,$key){

                                                if($key ==  'user_data'){
                                                    return true;
                                                }

                                                return [
                                                          'image_url'           =>  $image->images->standard_resolution->url,
                                                         'total_likes'          =>  $image->likes->count,
                                                         'total_comments'       =>  $image->comments->count,
                                                         'total_points'         =>  ($image->likes->count  * self::LIKE_POINTS) + ($image->comments->count * self::COMMENT_POINTS),
                                                         'instagram_post_link'  =>  $image->link
                                                    ];
                                            })->sortByDesc('total_points')->take(self::TOTAL_POSTS)->values();
        return $data;
    }

    public function resizeImage($image){

        try{
            $img    =   Image::make($image);
            $img->resize(self::IMAGE_HEIGHT, self::IMAGE_WIDTH);
        }catch (\Exception $exception){
            return false;
        }

        return $img;
    }

    /**
     * GET image extension from its MIME
     * @param $mime
     * @return string
     */
    public function getImageExtension($mime){

        if ($mime == 'image/jpeg')
            $extension = '.jpg';
        elseif ($mime == 'image/png')
            $extension = '.png';
        elseif ($mime == 'image/gif')
            $extension = '.gif';
        else
            $extension = '';

        return $extension;
    }
}