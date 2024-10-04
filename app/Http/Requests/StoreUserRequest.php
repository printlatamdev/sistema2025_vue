<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'email' => 'required|email|unique:users',
            'password' => 'required|password',
            'roles' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es requerido',
            'email.required' => 'El correo electrónico es requerido',
            'email.email' => 'El correo tiene un formato incorrecto',
            'email.unique' => 'El correo ingresado ya esta en uso',
            'password.required' => 'La contraseña es requerida',
            'password.password' => 'La contraseña no tiene un formato correspondiente',
            'roles.required' => 'El rol es requerido',
        ];
    }
}
