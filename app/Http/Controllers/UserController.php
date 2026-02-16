<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        // https://regexr.com/8jgjh
        $password_pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).{8,}$/';

        $validated = $request->validate([
            'name' => 'required|max:255|unique:users,name',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => ['required', 'string', 'min:8', 'regex:' . $password_pattern],
        ]);


        $validated['password'] = Hash::make($request->password);


        User::create($validated);

        return redirect('/login')->with('success', 'Created account Succesfully');

;
    }

}
