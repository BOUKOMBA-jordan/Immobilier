<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class VehicleImageController extends Controller
{
    public function index(int $vehicleId)
    {
        $vehicle = Vehicle::findOrFail($vehicleId);
        $pictures = Picture::where('vehicle_id', $vehicleId)->get();
        
        return view('vehicleImage.index', compact('vehicle', 'pictures'));
    }

    public function store(Request $request, int $vehicleId)
    {
        $request->validate([
            'pictures.*' => 'required|image|mimes:png,jfif,jpg,jpeg,webp|max:2048',
        ]);

        $vehicle = Vehicle::findOrFail($vehicleId);

        $imageData = [];
        if ($files = $request->file('pictures')) {
            foreach ($files as $key => $file) {
                $extension = $file->getClientOriginalExtension();
                $filename = $key . '-' . time() . '.' . $extension;

                $path = 'upload/vehicle/';

                $file->move(public_path($path), $filename);

                $imageData[] = [
                    'vehicle_id' => $vehicle->id,
                    'image' => $path . $filename,
                ];
            }

            Picture::insert($imageData);

            return redirect()->back()->with('status', 'Uploaded Successfully');
        } else {
            return redirect()->back()->with('status', 'Upload failed');
        }
    }
    
    public function destroy(int $vehicleImageId)
    {
        $vehicleImage = Picture::findOrFail($vehicleImageId);
        if (File::exists($vehicleImage->image)) {
            File::delete($vehicleImage->image);
        }
        $vehicleImage->delete();

        return redirect()->back()->with('status', 'Image Deleted');
    }
}