<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePurchaseorderRequest extends FormRequest
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
            'provider_id' => 'required|numeric',
            'approvedBy' => 'required',
            'requestedBy' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'provider_id.required' => 'El proveedor es requerido',
            'approvedBy.required' => 'Es requerido el nombre de la persona que aprobará la orden',
            'requestedBy.required' => 'Es requerido el nombre de la persona que solicita la orden',
        ];
    }
}
