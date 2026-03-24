<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function store(Request $request): RedirectResponse
    {

        $validated = $request->validate([
            'name' => 'required|max:255|unique:users,name',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => ['required', 'string', Password::min(8)->mixedCase()->numbers()->symbols()],
        ]);


        User::create($validated);

        return redirect('/login')->with('success', 'Created account successfully');


    }

    public function edit(User $user)
    {
        Gate::authorize('update', $user);

        return view('edit-user', compact('user'));
    }

    public function update(EditUserRequest $request, User $user): RedirectResponse
    {
        Gate::authorize('update', $user);

        $validated = $request->validated();
        if (empty($validated['password'])) {
            unset($validated['password']);
        }
        unset($validated['password_confirmation']);

        $user->update($validated);

        return redirect('/')->with('success', 'Updated credentials successfully.');
    }

}
