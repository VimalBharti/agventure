<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Post;
use App\Like;
use App\Inbox;

class User extends Authenticatable
{
    use Notifiable;
    use Sluggable;

    public function sluggable()
    {
        return [
            'username' => [
                'source' => 'name',
                'separator' => '_'
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

    public function posts()
    {
        return $this->hasMany('App\Post');
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
        return $this->belongsToMany('App\Post', 'likes', 'user_id', 'post_id');
    }
}
