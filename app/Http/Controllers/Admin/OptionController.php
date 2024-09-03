<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VehicleOptionFormRequest;
use App\Models\Option;

class OptionController extends Controller
{
    public function index()
    {
        return view('admin.options.index', [
            'options' => Option::paginate(25)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.options.form', [
            'option' => new Option()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VehicleOptionFormRequest $request)
    {
        try {
            $option = Option::create($request->validated());
            return to_route('admin.option.index')->with('success', 'L\'option a bien été créée');
        } catch (\Exception $e) {
            return to_route('admin.option.index')->with('error', 'Une erreur est survenue lors de la création de l\'option');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Option $option)
    {
        return view('admin.options.form', [
            'option' => $option
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VehicleOptionFormRequest $request, Option $option)
    {
        try {
            $option->update($request->validated());
            return to_route('admin.option.index')->with('success', 'L\'option a bien été modifiée');
        } catch (\Exception $e) {
            return to_route('admin.option.index')->with('error', 'Une erreur est survenue lors de la modification de l\'option');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Option $option)
    {
        try {
            $option->delete();
            return to_route('admin.option.index')->with('success', 'L\'option a bien été supprimée');
        } catch (\Exception $e) {
            return to_route('admin.option.index')->with('error', 'Une erreur est survenue lors de la suppression de l\'option');
        }
    }
}