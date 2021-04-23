<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceDetails extends Model
{
    protected $fillable = [
        'invoice_id',
        'invoice_number',
        'product',
        'section_id',
        'Status',
        'Value_Status',
        'note',
        'user',
        'Payment_Date',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
