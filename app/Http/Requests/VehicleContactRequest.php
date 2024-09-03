<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehicleContactRequest extends FormRequest
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
            'firstname' => ['required', 'string', 'min:2'],  // Prénom de l'utilisateur
            'lastname' => ['required', 'string', 'min:2'],   // Nom de l'utilisateur
            'phone' => ['required', 'string', 'min:9'],      // Téléphone de l'utilisateur
            'email' => ['required', 'email', 'min:4'],       // Email de l'utilisateur
            'message' => ['required', 'string', 'min:4']     // Message de l'utilisateur
        ];
    }
}