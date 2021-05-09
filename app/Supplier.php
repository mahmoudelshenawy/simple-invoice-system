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

    public function purchase_invoices()
    {
        return $this->hasMany(PurchaseInvoice::class);
    }
    public function purchase_orders()
    {
        return $this->hasMany(PurchaseOrder::class);
    }
}
