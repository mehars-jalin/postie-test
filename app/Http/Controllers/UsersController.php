<?php

namespace App\Http\Controllers;

use App\User;
use App\UserMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{

    public function InstagramLoginRedirect(){
        return view('instagram_login_redirect');
    }

    public function fetchInstagramImages(InstagramController $instagramController,Request $request,User $user){

        if(!Session::has('access_token')){

            if(!$request->has('access_token')){
                return redirect('/');
            }

            $access_token       =   $request->access_token;
            $in_response        =   $instagramController->fetchInstaData($access_token);
            $user               =   $user->findByInstaUserName($in_response->user_data->user_name);

            if(!$user){
                $user = User::create([
                    'name'                  =>  $in_response->user_data->full_name,
                    'insta_username'        =>  $in_response->user_data->user_name
                ]);
            }


            $this->handleUserMedia($in_response->image_data,$user,$instagramController);

            Session::put('access_token',$access_token);
        }


        $points =   $this->getAllPoints();

        return view('list_all_users')->with('points',$points);
    }

    private function handleUserMedia($images,$user,$instagramController){

        $images->each(function ($image) use($user, $instagramController){

            $image_data =   $instagramController->resizeImage($image['image_url']);

            if($image_data  === false) return true;

            $user_media =   UserMedia::create([
                                'user_id'               =>  $user->id,
                                'total_likes'           =>  $image['total_likes'],
                                'total_comments'        =>  $image['total_comments'],
                                'total_points'          =>  $image['total_points'],
                                'instagram_post_link'   =>  $image['instagram_post_link']
                            ]);

            try{
                $user_media->save();
            }catch (\Exception $exception){
                return false;
            }

            $extension  =   $instagramController->getImageExtension($image_data->mime());
            $file_name  =   str_random(8). time() .$extension;

            $user_media->addMediaFromBase64(base64_encode($image_data->encode()->encoded))
                ->usingFileName($file_name)
                ->toMediaCollection('instagram_images');
        });
        return true;
    }

    /**
     * For index {route} to List all users with their total points
     * @param Request $request
     * @return mixed
     */
    private function getAllPoints(){
        return \DB::select("SELECT *, (SELECT SUM( total_points ) FROM users_media ) as total_points FROM  users");
    }

    public function logout(){
        Session::forget('access_token');
        return redirect('/');
    }
}