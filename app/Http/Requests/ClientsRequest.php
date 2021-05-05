<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientsRequest extends FormRequest
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
            // 'reference_number' => 'required|numeric|max:6|unique:clients,reference_number,' . $this->id ?? '',
            'reference_number' => 'required|numeric|unique:clients,reference_number',
            'legal_name' => 'required|unique:clients,legal_name',
            'name' => 'required',
            'tin' => 'required|max:9',
            'agent' => 'required|numeric',
            'invoice_to' => 'nullable|numeric',
        ];
    }
}
