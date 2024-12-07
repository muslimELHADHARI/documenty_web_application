<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegistrationForm()
    {
        if (Auth::check()) {
            return redirect(route('home'));
        }
        return view('registration');
    }
    public function registerPost(Request $request)
    {
        $request->validate([
            'profile' => 'required|image|max:1024',
            'name' => 'required|string|max:255',
            'uid' => 'required|email|unique:users,email',
            'pwd' => 'required|min:6'
        ]);
        $filePath = $request->file('profile')->store('documents', 'public');
        $data = [
            'profile_pic' => $filePath,
            'role' => 'Normal User',
            'name' => $request->name,
            'email' => $request->uid,
            'password' => Hash::make($request->pwd),
        ];

        try {
            $user = User::create($data);
            if ($user) {
                return redirect(route('login'))->with("success", "Registration succeeded!");
            }
        } catch (\Exception $e) {
            return redirect(route('register'))->with("error", "Registration failed! Error: " . $e->getMessage());
        }
    }
    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return redirect(route('login'));
    }
}
