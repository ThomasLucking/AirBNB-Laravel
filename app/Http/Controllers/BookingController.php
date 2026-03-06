<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingsStoreRequest;
use App\Models\Apartment;
use App\Models\Booking;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function store(BookingsStoreRequest $request, Apartment $apartment)
    {

        $validated = $request->validated();
        $days = Carbon::parse($validated['start_date'])->diffInDays(Carbon::parse($validated['end_date']));
        $total = $apartment->price_per_night * $days;

        $alreadyBooked = Booking::where('apartment_id', $apartment->getKey())
            ->where('apartment_id', $apartment->getKey())
            ->where('start_date', '<', $validated['end_date'])
            ->where('end_date', '>', $validated['start_date'])
            ->exists();
        // checks between 5th and 10th january but if someones books 4th and 7th technically it's not between

        if ($alreadyBooked) {
            return back()->withErrors([
                'dataconflictError' => 'Apartment is not available at the specified dates',
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


    public function destroy(Apartment $apartment)
    {
        $booking = Booking::where('apartment_id', $apartment->getKey())
            ->where('user_id', auth()->id())
            ->where('end_date', '>=', now())
            ->first();

        if ($booking) {
            abort_if($booking->user_id !== auth()->id(), 403);
            $booking->delete();
            return redirect()->route('apartment.all')->with('success', 'Booking cancelled successfully.');
        } else {
            return back()->withErrors([
                'bookingError' => 'No active booking found to cancel.',
            ]);
        }




    }

}
