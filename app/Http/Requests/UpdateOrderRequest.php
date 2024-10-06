<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
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
            'status'            => 'required|string',
            'service_id.*'      => 'exists:services,id',
            'service_qty.*'     => 'integer|min:1',
            'part_id.*'         => 'exists:parts,id',
            'part_qty.*'        => 'integer|min:1',
        ];
    }
}
