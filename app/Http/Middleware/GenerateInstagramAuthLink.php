<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class GenerateInstagramAuthLink
{
    private $instagram_client_id;

    private $instagram_redirect_uri;

    public function __construct()
    {
        $this->instagram_client_id      =   config('services.instagram.client_id');
        $this->instagram_redirect_uri   =   config('services.instagram.redirect_uri');
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Session::has('access_token')){
            return redirect('/home');
        }
        $instagram_auth_url =   'https://www.instagram.com/oauth/authorize/?client_id='.$this->instagram_client_id.'&redirect_uri='.$this->instagram_redirect_uri.'&response_type=token&scope=likes+public_content';
        $request->request->add(['instagram_auth_url' => $instagram_auth_url]);
        return $next($request);
    }
}