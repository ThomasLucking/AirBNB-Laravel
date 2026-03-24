<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use DB;

class HomeController extends Controller
{
    public function index()
    {
        $topLocations = DB::table('bookings')
            ->join('apartments', 'apartments.id', '=', 'bookings.apartment_id')
            ->select('apartments.country', DB::raw('COUNT(*) as bookings_count'))
            ->groupBy('apartments.country')
            ->orderByDesc('bookings_count')
            ->limit(3)
            ->pluck('country');

        $apartmentsByCountry = Apartment::whereIn('country', $topLocations)
            ->with('images')
            ->get()
            ->groupBy('country');

        $locationData = $topLocations->map(function ($location) use ($apartmentsByCountry) {
            return [
                'location' => $location,
                'apartments' => $apartmentsByCountry->get($location, collect())->take(3),
            ];
        });

        return view('home', compact('locationData'));
    }
    //
}
