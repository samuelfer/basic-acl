<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePassword extends FormRequest
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
        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ];

        return $rules;
    }

    public function messages(): array
    {
        return [
            'email.required' => 'O email é obrigatório',
            'email.email' => 'O email precisa ser válido',
            'password.required' => 'O email é obrigatório',
            'password.min' => 'A senha precisa ter no mínimo 8 caracteres',
        ];
    }
}
