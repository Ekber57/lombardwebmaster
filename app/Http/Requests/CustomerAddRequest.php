<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerAddRequest extends FormRequest
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
            'name' => 'required|string|max:15',
            'lastname' => 'required|string|max:15',
            'middlename' => 'required|string|max:15',
            'phone' => 'required|string|max:10',
            'adress' => 'required|string|max:40',
            'fincode' => 'required|string|max:7|unique:customers',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Ad daxil edin.',
            'name.max' => 'Ad  maksimum 15 hərfdən ibarət ola bilər ',

            'lastname.required' => 'Soyad daxil edin.',
            'lastname.max' => 'Soyad  maksimum 15 hərfdən ibarət ola bilər ',
            
            'middlename.required' => 'Ata adı daxil edin',
            'middlename.max' => 'Ata adı  maksimum 15 hərfdən ibarət ola bilər ',

            'phone.required' => 'Telefon nömrəsi daxil edin.',
            'phone.max' => 'Telefon nömrəsi 10 rəqəmdən ibarət ola bilər.',


            'adress.required' => 'Adress daxil edin.',
            'adress.max' => 'Adress maksimum 40 hərf ve rəqəm qarışığından  ibarət ola bilər ',

            'fincode.required' => 'Finkod  daxil edin',
            'fincode.unique' => 'Finkod  artıq istifadə edilir',
            'fincode.max' => 'Finkod  maksimum 7 hərf ve rəqəm qarışığından  ibarət ola bilər ',
            // Diğer hata mesajlarını ekleyin
        ];
    }
}
