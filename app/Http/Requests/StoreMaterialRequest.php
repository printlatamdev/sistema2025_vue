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
            'quantity' => 'required|numeric',
            //'materialtype_id' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre del material es requerido',
            'name.quantity' => 'La cantidad de material es requerida',
            'materialtype_id.required' => 'El tipo del material es requerido',
            'materialtype_id.numeric' => 'El id del tipo de material es requerido',
        ];
    }
}
