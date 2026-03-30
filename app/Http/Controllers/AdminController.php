<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    public function show(): View
    {
        $users = User::select(['id', 'name', 'role'])->paginate(20);
        return view('admin-panel', compact('users'));
    }

    public function promote(User $user)
    {
        Gate::authorize('promote', $user);
        if ($user->role === 'admin') {
            return redirect()->route('admin.panel')->with('error', 'User is already an admin.');
        }
        $user->role = 'admin';
        $user->save();
        return redirect()->route('admin.panel')->with('success', 'User promoted to admin!');
    }


    public function destroy(User $user)
    {

        Gate::authorize('destroy', $user);

        DB::transaction(function () use ($user) {
            $apartmentIds = $user->apartments()->pluck('id');
            if ($apartmentIds->isNotEmpty()) {
                Booking::whereIn('apartment_id', $apartmentIds)->delete();

            }
            $user->bookings()->delete();
            $user->apartments()->delete();
            $user->delete();
        });

        return redirect()->route('admin.panel')->with('success', 'User successfully deleted');
    }



}
