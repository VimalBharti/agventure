<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Article extends Model
{
    protected $table = 'articles';
    protected $fillable = ['user_id', 'title', 'community_id', 'slug', 'content'];

    use Sluggable;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
                'separator' => '_',
                'maxLength' => 10,
                'maxLengthKeepWords' => true,
            ]
        ];
    }
}
