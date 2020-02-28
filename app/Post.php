<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\PostDetail;

class Post extends Model
{
    protected $table = 'posts';
    protected $primaryKey = 'id';

    protected $fillable = ['user_id', 'body'];


    public function user(){
        return $this->belongsTo('App\User');
    }

    public function postdetails(){
        return $this->hasMany('App\PostDetail', 'post_id');
    }

    public function videos(){
        return $this->hasMany('App\Video', 'post_id');
    }

    public function likes()
    {
        return $this->belongsToMany('App\User', 'likes');
    }

}
