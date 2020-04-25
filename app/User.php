<?php

namespace App;

use Laravel\Passport\HasApiTokens;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Post;
use App\Like;
use App\Inbox;

class User extends Authenticatable implements MustVerifyEmail
{
    use Sluggable, Notifiable, HasApiTokens;

    public function sluggable()
    {
        return [
            'username' => [
                'source' => 'name',
                'separator' => '.'
            ]
        ];
    }

    protected $fillable = [
        'name', 'email', 'password',
    ];

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

    public function posts(){
        return $this->hasMany('App\Post');
    }
    public function podcast(){
        return $this->hasMany('App\Podcast');
    }

    // A User can send a message
    public function sent(){
        return $this->hasMany(Inbox::class, 'sender_id');
    }
    // A user can also receiver a message
    public function received(){
        return $this->hasMany(Inbox::class, 'receiver_id');
    }

    public function likes()
    {
        return $this->belongsToMany(Post::class, 'likes', 'user_id', 'post_id')->withTimeStamps();
    }

}
