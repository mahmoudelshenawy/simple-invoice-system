<?php

namespace App\Exports;

use App\Invoice;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InvoicesExport implements FromCollection, WithHeadings
{

    public function headings(): array
    {
        return [
            'id', 'reference_number', 'title', 'date', 'delivery_date', 'email_sent_date', 'currency', 'payment_option', 'bank_account', 'status', 'agent', 'comments', 'private_comments', 'subtotal', 'total', 'discount', 'created_by'
        ];
    }

    public function collection()
    {
        return Invoice::all([
            'id',
            'Reference_number',
            'title', 'date', 'delivery_date', 'email_sent_date', 'currency', 'payment_option', 'bank_account', 'status', 'agent', 'comments', 'private_comments', 'subtotal', 'total', 'discount', 'created_by'
        ]);
    }
}
