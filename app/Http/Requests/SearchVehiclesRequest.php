<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchVehiclesRequest extends FormRequest
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
            'price' => ['numeric', 'gte:0', 'nullable'],         // Prix du véhicule
            'mileage' => ['numeric', 'gte:0', 'nullable'],       // Kilométrage du véhicule
            'year' => ['numeric', 'digits:4', 'nullable'],       // Année du modèle
            'make' => ['string', 'nullable'],                     // Marque du véhicule
            'model' => ['string', 'nullable'],                    // Modèle du véhicule
            'title' => ['string', 'nullable'],                    // Titre ou description du véhicule
        ];
    }
}