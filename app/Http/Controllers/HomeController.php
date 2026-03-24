<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Booking;
use DB;
class HomeController extends Controller
{
    public function index(Apartment $apartment, Booking $booking)
    {
        $topLocations = DB::table('bookings')
            ->join('apartments', 'apartments.id', '=', 'bookings.apartment_id')
            ->select('apartments.country', DB::raw('COUNT(*) as bookings_count'))
            ->groupBy('apartments.country')
            ->orderByDesc('bookings_count')
            ->limit(3)
            ->pluck('country');
            
        $locationData = $topLocations->map(function ($location) {
            $apartments = Apartment::where('country', $location)->with('images')->limit(2)->get();
            return [
                'location' => $location,
                'apartments' => $apartments
            ];
        });
        
        return view('home', compact('locationData'));

    }
    //
}
