<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;

class Video extends Model
{

    protected $fillable = ['post_id', 'filename'];
    protected $table = 'videos';
    protected $primaryKey = 'id';


    public function post(){
        return $this->belongsTo('App\Post');
    }
}
