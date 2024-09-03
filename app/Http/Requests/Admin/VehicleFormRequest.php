<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class VehicleFormRequest extends FormRequest
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
            'make' => ['required', 'min:2'], // Marque du véhicule (ex: Toyota)
            'model' => ['required', 'min:2'], // Modèle du véhicule (ex: Corolla)
            'year' => ['required', 'integer', 'min:1886'], // Année de fabrication (doit être une valeur raisonnable)
            'mileage' => ['required', 'integer', 'min:0'], // Kilométrage
            'price' => ['required', 'integer', 'min:0'], // Prix du véhicule
            'fuel_type' => ['required', 'in:petrol,diesel,electric,hybrid'], // Type de carburant (essence, diesel, etc.)
            'transmission' => ['required', 'in:manual,automatic'], // Transmission (manuelle ou automatique)
            'city' => ['required', 'min:2'], // Ville où se trouve le véhicule
            'address' => ['required', 'min:8'], // Adresse du lieu où se trouve le véhicule
            'postal_code' => ['required', 'min:3'], // Code postal du lieu où se trouve le véhicule
            'sold' => ['required', 'boolean'], // Véhicule vendu ou non
            'options' => ['array', 'exists:vehicle_options,id', 'required'] // Options spécifiques au véhicule
        ];
    }
}