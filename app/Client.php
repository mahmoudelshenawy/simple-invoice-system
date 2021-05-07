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

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
