<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Inbox extends Model
{
    protected $fillable = ['message', 'sender_id', 'receiver_id'];

    public function fromContact()
    {
        return $this->hasOne(User::class, 'id', 'sender_id');
    }

    // A message belongs to a sender
    public function sender(){
        return $this->belongsTo(User::class, 'sender_id');
    }

    // A message also belongs to a reveiver
    public function receiver(){
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
