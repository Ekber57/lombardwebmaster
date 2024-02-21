<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegistirationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    // public function failedValidation(Validator $validator) {
    //     $errors = $validator->errors();
    //     throw new HttpResponseException(response()->json($errors));
    // }

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
            'password' => 'required|string|min:8',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Ad daxil edin.',
            'name.max' => 'Ad  maksimum 15 hərfdən ibarət ola bilər ',

            'name.required' => 'Soyad daxil edin.',
            'name.max' => 'Soyad  maksimum 15 hərfdən ibarət ola bilər ',

            'name.required' => 'Ata adi daxil edin.',
            'name.max' => 'Ata adi  maksimum 15 hərfdən ibarət ola bilər ',

            'password.required' => 'Sifre  daxil edin.',
            'password.min' => 'Sifre adi  minimum 8 hərfdən ibarət ola bilər ',
            // Diğer hata mesajlarını ekleyin
        ];
    }
}
