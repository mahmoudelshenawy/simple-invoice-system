<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'invoice_number' => 'required',
            'invoice_Date' => 'required',
            'Due_date' => 'required',
            'product' => 'required',
            'section_id' => 'required|numeric',
            'Amount_collection' => 'required|numeric',
            'Amount_Commission' => 'required|numeric',
            'Discount' => 'required|numeric',
            'Value_VAT' => 'required|numeric',
            'Rate_VAT' => 'required',
            'Total' => 'required|numeric',
            'note' => 'nullable',
        ];
    }
}
