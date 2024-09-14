<?php

namespace App\Http\Controllers;

use App\Http\Requests\PropertyContactRequest;
use App\Http\Requests\SearchPropertiesRequest;
use App\Mail\PropertyContactMail;
use App\Models\Property;
use Illuminate\Support\Facades\Mail;
//use Illuminate\Database\Eloquent\ModelNotFoundException;

class PropertyController extends Controller
{
    public function index(SearchPropertiesRequest $request)
    {
        $query = Property::query()->orderBy('created_at', 'desc');
        $validated = $request->validated();
        
        try {
            if (isset($validated['price'])) {
                $query = $query->where('price', '<=', $validated['price']);
            }
            
            if (isset($validated['surface'])) {
                $query = $query->where('surface', '>=', $validated['surface']);
            }
            
            if (isset($validated['rooms'])) {
                $query = $query->where('rooms', '>=', $validated['rooms']);
            }

            if (isset($validated['title'])) {
                $query = $query->where('title', 'like', "%{$validated['title']}%");
            }

            if (isset($validated['image'])) {
                $query = $query->where('image', 'like', "%{$validated['image']}%");
            }
            
            return view('property.index', [
                'properties' => $query->paginate(16),
                'input' => $validated
            ]);
        } catch (\Exception $e) {
            // Log the exception or handle it as needed
            return view('property.index')->with('error', 'Une erreur est survenue lors de la recherche de propriétés.');
        }
    }

    public function show(string $slug, Property $property)
    {
        $expectedSlug = $property->getSlug();
        if ($slug !== $expectedSlug) {
            return redirect()->route('property.show', ['slug' => $expectedSlug, 'property'=> $property]);
        }
        
        return view('property.show', [
            'property' => $property
        ]);
    }

    public function contact(Property $property, PropertyContactRequest $request) 
    {
        try {
            Mail::send(new PropertyContactMail($property, $request->validated()));
            return back()->with('success', 'Votre demande de contact a bien été envoyée');
        } catch (\Exception $e) {
            // Log the exception or handle it as needed
            return back()->with('error', 'Une erreur est survenue lors de l\'envoi de votre demande de contact.');
        }
    }
}