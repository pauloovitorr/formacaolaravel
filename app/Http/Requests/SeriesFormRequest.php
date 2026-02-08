<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeriesFormRequest extends FormRequest
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
            'titulo' => ['required', 'min:3', 'max:150'],
            'cover' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }


    public function messages(): array
    {
        return [
            'titulo.required' => 'O campo título é obrigatório.',
            'titulo.min' => 'O campo título deve ter no mínimo :min caracteres.',
            'titulo.max' => 'O campo título deve ter no máximo :max caracteres.',

            'cover.image' => 'O arquivo enviado deve ser uma imagem válida.',
            'cover.mimes' => 'A imagem deve estar nos formatos: jpg, jpeg, png ou webp.',
            'cover.max' => 'A imagem deve ter no máximo 2MB.',
        ];
    }



}
