<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApartmentStoreRequest;
use App\Models\Apartment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ApartmentController extends Controller
{
    public function show(Apartment $apartment)
    {
        return view('details', [
            'apartment' => $apartment,

        ]);
    }

    public function index(Request $request)
    {
        $apartments = Apartment::query()
            ->with('images')
            ->when(
                $request->filled('apartments') && auth()->check(),
                fn ($q) => $q->ownedByUser(auth()->id())
            )
            ->when(
                $request->filled('bookings') && auth()->check(),
                fn ($q) => $q->bookedByUser(auth()->id())
            )

            ->when($request->filled('sort_price'), fn ($q) => $q->orderBy('price_per_night', 'asc'))
            ->when($request->filled('sort_rooms'), fn ($q) => $q->orderBy('rooms', 'asc'))
            ->paginate(15)->withQueryString();


        return view('all-apartments', compact('apartments'));
    }

    public function store(ApartmentStoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $apartmentData = collect($validated)->except('image_housing')->all();

        $images = $request->file('image_housing');

        try {
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
        } catch (Exceptions) {
            return redirect('apartments.store')->with('error', 'There was an error creating your apartment');

        }



    }



}
