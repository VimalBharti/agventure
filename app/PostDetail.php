<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;

class PostDetail extends Model
{
    protected $fillable = ['post_id', 'filename'];
    protected $table = 'post_details';
    protected $primaryKey = 'id';

    public function post(){
        return $this->belongsTo('App\Post');
    }
}
