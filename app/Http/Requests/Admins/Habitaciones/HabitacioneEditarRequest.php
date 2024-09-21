<?php

namespace App\Http\Requests\Admins\Habitaciones;

use Illuminate\Foundation\Http\FormRequest;

class HabitacioneEditarRequest extends FormRequest
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
            'Piso' => ['required', 'integer', 'min_digits:1', 'max_digits:2'],
            'Tipo' => ['required', 'string', 'min:1', 'max:1'],
            'Disponibilidad' => ['required', 'string', 'min:1', 'max:1'],
            'NumPersonas' => ['required', 'integer']
        ];
    }
}
