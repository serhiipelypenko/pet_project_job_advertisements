<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function update(Request $request): RedirectResponse {
        // Get logged in user
        $user = Auth::user();

        // Validate data
        $validatedData = $request->validate([
           'name' => 'required|string',
           'email' => 'required|email|nullable',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if($request->hasFile('avatar')) {
            // Delete old avatar
            if($user->avatar){
                Storage::delete('public/' . $user->avatar);
            }

            // Store new avatar
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        // Update user info
        $user->save();

        return redirect()->route('dashboard')->with('success', 'Profile updated successfully!');
    }
}
