<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseInvoice extends Model
{
    protected $guarded = [];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    public function agent()
    {
        return $this->belongsTo(User::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }
    public function services()
    {
        return $this->belongsToMany(Service::class)->withPivot('quantity');
    }
    public function expensesInvestments()
    {
        return $this->belongsToMany(ExpenseInvestment::class)->withPivot('quantity');
    }
}
