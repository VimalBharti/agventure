<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Auth;

class Podcast extends Model
{
    protected $table = 'podcasts';

    protected $fillable = ['user_id', 'about', 'audio', 'image'];

    use Sluggable;

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
}
