<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingsStoreRequest;
use App\Models\Apartment;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;

class BookingController extends Controller
{
    public function store(BookingsStoreRequest $request, Apartment $apartment)
    {
        if ($apartment->user_id === auth()->id()) {
            return back()->withErrors([
                'ownershipError' => 'You cannot book your own apartment.',
            ])->withInput();
        }

        $validated = $request->validated();
        $days  = Carbon::parse($validated['start_date'])->diffInDays(Carbon::parse($validated['end_date']));
        $total = $apartment->price_per_night * $days;

        $alreadyBooked = Booking::where('apartment_id', $apartment->getKey())
            ->where('start_date', '<', $validated['end_date'])
            ->where('end_date', '>', $validated['start_date'])
            ->exists();

        if ($alreadyBooked) {
            return back()->withErrors([
                'dataconflictError' => 'Apartment is not available at the specified dates',
            ])->withInput();
        }

        Booking::create([
            ...$validated,
            'user_id'      => auth()->id(),
            'apartment_id' => $apartment->getKey(),
            'total'        => $total,
        ]);

        return redirect()->route('apartment.all')->with('success', 'Booking confirmed!');
    }


    public function destroy(Booking $booking)
    {
        Gate::authorize('delete', $booking);

        if (Carbon::parse($booking->start_date)->isPast()) {
            return back();
        }
        
        $booking->delete();
        return redirect()->route('apartment.all')->with('success', 'Booking cancelled successfully.');
    }

    public function index()
    {
        $bookings = Booking::with('apartment')
            ->where('user_id', auth()->id())
            ->paginate(10);

        return view('my-bookings', compact('bookings'));
    }

}
