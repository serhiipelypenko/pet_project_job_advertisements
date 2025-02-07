<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\User;

class RegisterController extends Controller
{
    // @desc Show register form
    // @route GET /register
    public function register(): View {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse {
        $validateData = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $validateData['password'] = Hash::make($validateData['password']);

        //Create user
        $user = User::create($validateData);

        return redirect()->route('login')->with('success', 'You are registered and can login!');
    }
}
