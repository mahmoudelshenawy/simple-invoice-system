<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $guarded = [];

    public function agent()
    {
        return $this->belongsTo(User::class);
    }

    public function invoiceTo()
    {
        return $this->belongsTo(Client::class, 'invoice_to');
    }
}
