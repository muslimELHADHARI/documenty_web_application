<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\Item;
use Illuminate\Support\Facades\Storage;
use Stevebauman\Location\Facades\Location;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('include.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|min:8',
            'profile_pic' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];

        if ($request->filled('password')) {
            $user->password = Hash::make($validatedData['password']);
        }

        if ($request->hasFile('profile_pic')) {
            Storage::delete($user->profile_pic);
            $path = $request->file('profile_pic')->store('profile_pics', 'public');
            $user->profile_pic = $path;
        }
        //$user->save();
        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully!');
    }
    public function show()
    {
        $user = Auth::user();
        $ip = request()->ip() === '127.0.0.1' ? '102.111.255.255' : request()->ip();
        $location = Location::get($ip);
        $activities = Activity::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
        $documents = Item::select('title', 'file_path', 'created_at')
            ->where('user_id', $user->id)
            ->whereNotNull('file_path')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('include.profile', compact('user', 'activities', 'documents', 'location'));
    }
}
