<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;
use App\PostDetail;
use App\Like;
use App\Community;
use App\Comment;
use Auth;


class Post extends Model
{
    
    protected $table = 'posts';
    protected $primaryKey = 'id';
    
    protected $fillable = ['user_id', 'about', 'community_id'];
    
    use Sluggable, SoftDeletes;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'about',
                'separator' => '_',
                'maxLength' => 30,
                'maxLengthKeepWords' => true,
            ]
        ];
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function community(){
        return $this->belongsTo('App\Community');
    }

    public function postdetails(){
        return $this->hasMany('App\PostDetail', 'post_id');
    }


    public function videos(){
        return $this->hasMany('App\Video', 'post_id');
    }

    public function favorited(){
        return (bool) Like::where('user_id', Auth::id())->where('post_id', $this->id)->first();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

}
