<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

      /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit()
    {
        $user = Auth::user(); 
        return view('profile.edit', compact('user'));
    }
    public function update(Request $request)
    {
        $user = Auth::user();

        // Update user's name and email
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        // Update user's bio
        $user->bio = $request->input('bio');
        $user->save();

        // Update user's profile photo
        if ($request->hasFile('profile_photo')) {
            $request->validate([
                'profile_photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $currentProfilePhotoPath = $user->profile_photo_path;

            // Delete the current profile photo if it exists
            if ($currentProfilePhotoPath) {
                Storage::disk('public')->delete($currentProfilePhotoPath);
            }

            // Store the new profile photo
            $profilePhotoPath = $request->file('profile_photo')->store('profile_photos', 'public');
            $user->profile_photo_path = $profilePhotoPath;
            $user->save();
        }

        return redirect()->back()->with('status', 'Profile updated successfully.');
    }

    public function destroy()
    {
        // Delete the user's account if needed
        Auth::user()->delete();
        return redirect()->route('home')->with('status', 'Account deleted successfully.');
    }
}
