<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingsStoreRequest;
use App\Models\Apartment;
use App\Models\Booking;
use Carbon\Carbon;

class Bookings extends Controller
{
    public function store(BookingsStoreRequest $request, Apartment $apartment)
    {
        $validated = $request->validated();
        $days = Carbon::parse($validated['start_date'])->diffInDays(Carbon::parse($validated['end_date']));
        $total = $apartment->price_per_night * $days;

        $alreadyBooked = Booking::where('user_id', auth()->user()->id)
            ->where('apartment_id', $apartment->getKey())
            ->exists();

        $dateConflict = Booking::where('apartment_id', $apartment->id)
            ->where('start_date', '<=', $validated['end_date'])
            ->where('end_date', '>=', $validated['start_date'])
            ->exists();
        // checks between 5th and 10th january but if someones books 4th and 7th technically it's not between

        if ($dateConflict) {
            return back()->withErrors([
                'error' => 'Apartment is not available at the specified dates',
            ])->withInput();
        }
        if ($days <= 0) {
            return back()->withErrors([
            'start_date' => 'You provided an invalid date',
            'end_date' => 'You provided an invalid date'
            ])->withInput();
        }

        if ($alreadyBooked) {
            return back()->withErrors([
                'error' => 'You already booked this apartment',
            ])->withInput();
        }

        Booking::create([
            ...$validated,
            'user_id'      => auth()->id(),
            'apartment_id' => $apartment->getKey(),
            'total' => $total
        ]);

        return redirect()->route('apartment.all')->with('success', 'Booking confirmed!');
    }

}
