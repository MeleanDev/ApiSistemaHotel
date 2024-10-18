<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class UserRequest extends FormRequest
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
            'nombre' => ['required', 'string', 'min:1', 'max:255'],
            'apellido' => ['required', 'string', 'min:1', 'max:255'],
            'identificacion' => ['required', 'string', 'min:7', 'max:20'],
            'telefono' => ['required', 'string', 'min:7', 'max:20'],
            'email' => ['required', 'string', 'lowercase', 'email'],
            'password' => ['required', Rules\Password::defaults()],
            'sede_id' => ['string']
        ];
    }
}
