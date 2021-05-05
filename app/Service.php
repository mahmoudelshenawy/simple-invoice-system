<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $guarded = [];
    protected $appends = ['imagePath'];


    public function getImagePathAttribute()
    {
        if ($this->attributes['image'] !== null) {
            return "Attachments/Services/"  . $this->attributes['reference_number'] . '/' . $this->attributes['image'];
        } else {
            return "Attachments/default.jpg";
        }
    }

    public function attachment()
    {
        return $this->morphMany(Attachment::class, 'imageable');
    }

    public function deleteAttachs()
    {
        $this->attachment()->delete();
    }

    public function purchaseOrders()
    {
        return $this->belongsToMany(PurchaseOrder::class)->withPivot('quantity');
    }
    public function purchaseInvoices()
    {
        return $this->belongsToMany(PurchaseInvoice::class)->withPivot('quantity');
    }
    public function sales()
    {
        return $this->belongsToMany(Sale::class)->withPivot('quantity');
    }
    public function invoices()
    {
        return $this->belongsToMany(Invoice::class)->withPivot('quantity');
    }
}
