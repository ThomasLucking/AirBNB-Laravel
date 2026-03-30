<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    //

    public function show(): View
    {
        $users = User::select(['id', 'name', 'role'])->paginate(20);
        return view('admin-panel', compact('users'));
    }

    public function promote(User $user)
    {
        Gate::authorize('promote', $user);
        $user->update(['role' => 'admin']);
        return redirect()->route('admin.panel')->with('success', 'User Updated!');


    }


    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.panel')->with('error', 'You cannot delete yourself.');
        }

        Gate::authorize('destroy', $user);

        DB::transaction(function () use ($user) {
            $apartmentIds = $user->apartments()->pluck('id');
            if ($apartmentIds->isNotEmpty()) {
                DB::table('bookings')->whereIn('apartment_id', $apartmentIds)->delete();
            }
            $user->bookings()->delete();
            $user->apartments()->delete();
            $user->delete();
        });

        return redirect()->route('admin.panel')->with('success', 'User successfully deleted');
    }



}
