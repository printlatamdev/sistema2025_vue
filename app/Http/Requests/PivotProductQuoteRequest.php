<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PivotProductQuoteRequest extends FormRequest
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
            'price' => 'required',
            'quantity' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'product_id' => 'required|integer',
            'quote_id' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'price.required' => 'El precio es requerido',
            'quantity.required' => 'La cantidad es requerida',
            'image.required' => 'La imagen es requerida',
            'image.image' => 'El archivo subido no es una imagen',
            'image.mimes' => 'El formato de la imagen es requerida',
            'product_id.required' => 'El producto es requerido',
            'quote_id.required' => 'La cotización es requerida',
        ];
    }
}
