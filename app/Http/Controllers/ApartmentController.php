<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApartmentStoreRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ApartmentController extends Controller
{
    public function store(ApartmentStoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $apartmentData = collect($validated)->except('image_housing')->all();

        $images = $request->file('image_housing');

        return DB::transaction(function () use ($apartmentData, $images) {
            $apartment = auth()->user()->apartments()->create($apartmentData);

            if ($images) {
                foreach ($images as $file) {
                    $path = Storage::disk('public')->putFile('images', $file);

                    $apartment->images()->create([
                        'image_path' => $path
                    ]);
                }
            }
            return redirect('/')->with('success', 'Created Apartment successfully');
        });



    }



}
