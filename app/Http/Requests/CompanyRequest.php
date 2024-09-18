<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'commercial_name' => 'required',
            'social_reason' => 'required',
            'cellphone' => 'required',
            'nrc' => 'required',
            '' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'commercial_name.required' => 'El nombre comercial es requerido',
            'social_reason.required' => 'La razón social es requerida',
            'cellphone.required' => 'El número de celular es requerido',
            'nrc.required' => 'El NRC es requerido',
            'nit.required' => 'El NIT es requerido',
        ];
    }
}
