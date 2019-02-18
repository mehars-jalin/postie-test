<?php

namespace App\Http\Controllers;

use App\User;
use App\UserMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UsersMediaController extends Controller
{
    public $user;

    public function __construct(User $user)
    {
        $this->user =   $user;
    }

    /**
     * GET the media details with username
     */
    public function mediaByUserName($user_name,UserMedia $userMedia){

        $user           =   $this->user->findByInstaUserName($user_name);

        if(is_null($user)){
            return response()->json(['error'    =>  'Invalid Instagram user detected!']);
        }

        $users_media    =   $userMedia->where('user_id',$user->id)->orderBy('total_points','desc')->get()->take(6);

        return view('list_my_images')->with(['user_media'=>$users_media,'user_name' =>  $user_name]);
    }

    /**
     * Fetch one single Image
     * @param $user_name
     * @param $image_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function accessSingleImage($user_name,$image_id){

        $user_media         =   UserMedia::find($image_id);

        if(is_null($user_media)){
            return response()->json(['error'    =>  'Invalid image ID provided']);
        }

        return view('image_details')->with(['user_media'    =>  $user_media]);
    }

    public function sendEmail(Request $request){

        $this->validate($request, [
            'email' => 'required|email'
        ]);

        try{
            \Mail::to($request->email)->queue($request->all());
        }catch (\Exception $exception){
            return redirect()->back(500);
        }

        return redirect()->back(200);
    }
}