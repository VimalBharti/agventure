<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;

class Video extends Model
{

    protected $fillable = ['post_id', 'video'];
    protected $table = 'videos';
    protected $primaryKey = 'id';


    public function post(){
        return $this->belongsTo('App\Post');
    }
}
