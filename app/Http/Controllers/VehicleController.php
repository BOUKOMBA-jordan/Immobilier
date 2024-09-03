<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleContactRequest;
use App\Http\Requests\SearchVehiclesRequest;
use App\Mail\VehicleContactMail;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Mail;

class VehicleController extends Controller
{
    public function index(SearchVehiclesRequest $request)
    {
        $query = Vehicle::query()->orderBy('created_at', 'desc');
        $validated = $request->validated();
        
        try {
            if (isset($validated['price'])) {
                $query = $query->where('price', '<=', $validated['price']);
            }
            
            if (isset($validated['mileage'])) {
                $query = $query->where('mileage', '<=', $validated['mileage']);
            }
            
            if (isset($validated['make'])) {
                $query = $query->where('make', 'like', "%{$validated['make']}%");
            }

            if (isset($validated['model'])) {
                $query = $query->where('model', 'like', "%{$validated['model']}%");
            }

            if (isset($validated['year'])) {
                $query = $query->where('year', '=', $validated['year']);
            }
            
            return view('vehicle.index', [
                'vehicles' => $query->paginate(16),
                'input' => $validated
            ]);
        } catch (\Exception $e) {
            // Log the exception or handle it as needed
            return view('vehicle.index')->with('error', 'Une erreur est survenue lors de la recherche de véhicules.');
        }
    }

    public function show(string $slug, Vehicle $vehicle)
    {
        $expectedSlug = $vehicle->getSlug();
        if ($slug !== $expectedSlug) {
            return redirect()->route('vehicle.show', ['slug' => $expectedSlug, 'vehicle'=> $vehicle]);
        }
        
        return view('vehicle.show', [
            'vehicle' => $vehicle
        ]);
    }

    public function contact(Vehicle $vehicle, VehicleContactRequest $request) 
    {
        try {
            Mail::send(new VehicleContactMail($vehicle, $request->validated()));
            return back()->with('success', 'Votre demande de contact a bien été envoyée');
        } catch (\Exception $e) {
            // Log the exception or handle it as needed
            return back()->with('error', 'Une erreur est survenue lors de l\'envoi de votre demande de contact.');
        }
    }
}