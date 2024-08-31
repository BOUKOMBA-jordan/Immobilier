<?php

namespace App\Http\Controllers;

use App\Models\Picture;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rules\Exists;

class PictureController extends Controller
{
    public function index(int $propertyId)
    {
        $property = Property::findOrFail($propertyId);
        $pictures = Picture::where('property_id', $propertyId)->get();
        
        return view('propertyImage.index', compact('property', 'pictures'));
    }

    public function store(Request $request, int $propertyId)
    {
        $request->validate([
            'pictures.*' => 'required|image|mimes:png,jfif,jpg,jpeg,webp|max:2048',
        ]);

        $property = Property::findOrFail($propertyId);

        $imageData = [];
        if ($files = $request->file('pictures')) {
            foreach ($files as $key => $file) {
                $extension = $file->getClientOriginalExtension();
                $filename = $key . '-' . time() . '.' . $extension;

                $path = 'upload/property/';

                $file->move(public_path($path), $filename);

                $imageData[] = [
                    'property_id' => $property->id,
                    'image' => $path . $filename,
                ];
            }

            Picture::insert($imageData);

            return redirect()->back()->with('status', 'Uploaded Successfully');
        } else {
            return redirect()->back()->with('status', 'Upload failed');
        }
    }
    
    public function destroy(int $propertyImageId)
    {
        $propertyImage = Picture::findOrFail($propertyImageId);
        if(File::Exists($propertyImage->image)){
            File::delete($propertyImage->image);
        }
        $propertyImage->delete();

        return redirect()->back()->with('status', 'Image Deleted');
    }
}