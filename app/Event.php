<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

use App\User;

class Event extends Model
{

    use Sluggable;

    protected $table = 'events';

    protected $fillable = [
        'title', 'image', 'about', 'date', 'location', 'fees', 'timming', 'highlightA', 'highlightB', 'highlightC'
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
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
