<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded = [];

    public function sender()
    {
        return $this->hasOne(User::class, 'id', 'from');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'to');
    }
}
