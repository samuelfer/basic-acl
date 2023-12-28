<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateImageProfile extends FormRequest
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];

        return $rules;
    }

    public function messages(): array
    {
        return [
            'image.required' => 'A imagem é obrigatória',
            'image.image' => 'A imagem precisa ser um arquivo válido',
            'image.mimes' => 'A imagem precisa ser do tipo jpeg,png,jpg,gif ou svg',
            'image.max' => 'O tamanho máximo permitido de 2048 m',
        ];
    }
}
