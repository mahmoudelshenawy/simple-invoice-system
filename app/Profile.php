<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['name', 'language', 'address', 'phone_1', 'phone_2', 'tin', 'image', 'user_id'];
    protected $appends = ['avatar'];


    public function getAvatarAttribute()
    {
        return "Images" . '/' . $this->user->name . '/' . $this->attributes['image'];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
