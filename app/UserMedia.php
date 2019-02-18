<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class UserMedia extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $table    =   'users_media';

    protected $fillable =   [
            'user_id',
            'total_likes',
            'total_comments',
            'total_points',
            'instagram_post_link'
    ];

    public function users(){
        return $this->belongsTo(User::class);
    }
}
