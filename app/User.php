<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Request;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'insta_username',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function findByInstaUserName($username){
        return $this->where('insta_username',$username)->first();
    }

    public function UserMedia(){
        return $this->hasMany(UserMedia::class,'user_id','id');
    }

    public function getTotalPointsOfAuser(){
        return $this->hasMany(UserMedia::class)->select(['user_id','total_points']);
    }
}
