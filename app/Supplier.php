<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $guarded = [];

    public function agent()
    {
        return $this->belongsTo(User::class);
    }
}
