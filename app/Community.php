<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Post;

class Community extends Model
{
    use Sluggable;

    protected $table = 'communities';

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
                'separator' => '_'
            ]
        ];
    }

    public function posts(){
        return $this->hasMany('App\Post');
    }
}
