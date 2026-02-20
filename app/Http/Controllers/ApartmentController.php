<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApartmentStoreRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class ApartmentController extends Controller
{
    public function store(ApartmentStoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        
        $images = $request->file('image_housing');
        
        $apartment = auth()->user()->apartments()->create($validated);

        foreach ($images as $file) {
            $path = Storage::disk('public')->putFile('images', $file);

            $apartment->images()->create([
                'image_path' => $path
            ]);
        }

        return redirect('/')->with('success', 'Created Apartment successfully');
    }


}
