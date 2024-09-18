<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuoteRequest extends FormRequest
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
            'user_id' => 'required|integer',
            'company_id' => 'required|integer',
            'contact_id' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'El vendedor es requerido',
            'company_id.required' => 'El cliente es requerido',
            'contact_id.required' => 'El contacto es requerido',
        ];
    }
}
