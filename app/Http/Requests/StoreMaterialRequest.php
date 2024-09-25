<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMaterialRequest extends FormRequest
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
            'name' => 'required',
            'category_id' => 'required|integer',
            'type_id' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre del material es requerido',
            'category_id.required' => 'La categoria del material es requerida',
            'category_id.integer' => 'El id de la categoría de material es requerido',
            'type_id.required' => 'El tipo del material es requerido',
            'type_id.integer' => 'El id del tipo de material es requerido',
        ];
    }
}
