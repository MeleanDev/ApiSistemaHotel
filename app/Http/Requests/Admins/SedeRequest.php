<?php

namespace App\Http\Requests\Admins;

use Illuminate\Foundation\Http\FormRequest;

class SedeRequest extends FormRequest
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
            'nombre' => ['required', 'string', 'min:1', 'max:45'],
            'pais' => ['required', 'string', 'min:1', 'max:45'],
            'estado' => ['required', 'string', 'min:1', 'max:45'],
            'municipio' => ['required', 'string', 'min:1', 'max:45'],
            'direccion' => ['required', 'string', 'min:1', 'max:45']
        ];
    }
}
