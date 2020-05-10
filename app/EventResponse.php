<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventResponse extends Model
{
    protected $table = 'event_response';

    protected $fillable = [
        'auth_id', 'event_id', 'title', 'name', 'email', 'phone'
    ];
}
