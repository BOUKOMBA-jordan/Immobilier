<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VehicleFormRequest;
use App\Models\Option;
use App\Models\Picture;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    public function index()
    {
        return view('admin.vehicles.index', [
            'vehicles' => Vehicle::orderBy('created_at', 'desc')->withTrashed()->paginate(25)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.vehicles.form', [
            'vehicle' => new Vehicle(),
            'options' => Option::pluck('name', 'id'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VehicleFormRequest $request)
    {
        try {
            // Création du véhicule avec les données validées
            $vehicle = Vehicle::create($request->validated());

            // Attacher les options sélectionnées
            $vehicle->options()->sync($request->input('options', []));

            // Ajouter les fichiers
            $vehicle->attachFiles($request->file('pictures', []));

            return to_route('admin.vehicle.index')->with('success', 'Le véhicule a bien été créé');
        } catch (\Exception $e) {
            Log::error('Erreur lors de la création du véhicule : ' . $e->getMessage());
            return to_route('admin.vehicle.index')->with('error', 'Une erreur est survenue lors de la création du véhicule');
        }
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle)
    {
        return view('admin.vehicles.form', [
            'vehicle' => $vehicle,
            'options' => Option::pluck('name', 'id'),
            'selectedOptions' => $vehicle->options->pluck('id')->toArray(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VehicleFormRequest $request, Vehicle $vehicle)
    {
        // Mise à jour du véhicule avec les données validées
        $vehicle->update($request->validated());

        // Attacher les options sélectionnées
        $vehicle->options()->sync($request->input('options', []));

        // Ajouter les fichiers
        $vehicle->attachFiles($request->file('pictures', []));

        return to_route('admin.vehicle.index')->with('success', 'Le véhicule a bien été modifié');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        try {
            // Supprimer les images du stockage
            foreach ($vehicle->pictures as $picture) {
                Storage::disk('public')->delete($picture->filename);
                $picture->delete();
            }

            // Supprimer les options associées
            $vehicle->options()->detach();

            // Supprimer le véhicule
            $vehicle->delete();

            return to_route('admin.vehicle.index')->with('success', 'Le véhicule a bien été supprimé');
        } catch (\Exception $e) {
            // Enregistrez l'erreur ou gérez-la comme vous le souhaitez
            return to_route('admin.vehicle.index')->with('error', 'Une erreur est survenue lors de la suppression du véhicule');
        }
    }

}