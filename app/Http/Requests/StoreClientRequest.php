<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
            'name'                  => 'required|min:3|max:100',
            'email'                 => 'required|string|email|max:100|unique:clients',
            'phone'                 => 'required|string|min:8|max:20',
            'address'               => 'required|string|max:150',
        ];
    }

    public function messages()
    {
        return [
            'name.required'         => 'O nome é obrigatório.',
            'name.min'              => 'O nome deve ter pelo menos :min caracteres.',
            'email.required'        => 'O email é obrigatório.',
            'email.email'           => 'O email deve ser válido.',
            'phone.required'        => 'O telefone é obrigatório.',
            'address.required'      => 'O endereço é obrigatório.',
        ];
    }
}
