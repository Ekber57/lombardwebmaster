<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreditAddRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'customer_id' => 'required|string|max:100|exists:customers,id',
            'amount' => 'required|numeric|min:50|max:10000',
            'duration' => 'required|numeric|min:2|max:48',
        ];
    }
    public function messages()
    {
        return [
            'amount.required' => 'Məbləğ daxil edin.',
            'amount.max' => 'Məbləğ maksimum 10.000 azn ola bilər ',
            'amount.min' => 'Məbləğ minimum 50 azn ola bilər ',
            'duration.required' => 'Müddət daxil edin.',
            'duration.max' => 'Müddət maksimum 48 ay ola bilər ',
            'duration.min' => 'Müddət minimum 2 ay ola bilər ',

        ];
    }
}
