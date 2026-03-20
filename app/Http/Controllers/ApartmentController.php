<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApartmentStoreRequest;
use App\Http\Requests\ApartmentUpdateRequest;
use App\Models\Apartment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ApartmentController extends Controller
{
    public function show(Apartment $apartment)
    {

        $apartment->load('images');
        return view('details', [
            'apartment' => $apartment,
            'hasActiveBooking' => $apartment->activeBookingForUser(),
        ]);
    }

    public function index(Request $request)
    {
        $apartments = Apartment::query()
            ->with('images')
            ->withExists('bookings')
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

        $apartmentData = collect($validated)->except(keys: 'image_housing')->all();

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


    public function edit(Apartment $apartment)
    {
        return view('edit-apartments', compact('apartment'));
    }

    public function update(ApartmentUpdateRequest $request, Apartment $apartment)
    {
        Gate::authorize('update', $apartment);

        $validated = collect($request->validated())->except('image_housing')->all();
        $images = $request->file('image_housing');
        
        try {
            return DB::transaction(function () use ($apartment, $validated, $images) {
                $apartment->update($validated);

                if ($images) { 
                    foreach ($apartment->images as $image) {
                        Storage::disk('public')->delete($image->image_path);
                        $image->delete();
                    }
                    foreach ($images as $file) {
                        $path = Storage::disk('public')->putFile('images', $file);
                        $apartment->images()->create([
                            'image_path' => $path
                        ]);
                    }
                }

                return redirect()->route('apartment.all')->with('success', 'Listing updated!');
            });
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'There was an error updating your apartment');
        }
    }
}
