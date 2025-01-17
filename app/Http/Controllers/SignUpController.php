<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SignupController extends Controller
{
    public function index()
    {
        return view('signup');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:student,professor'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        if ($request->role === 'professor') {
            return redirect()->route('setup.pin', ['user' => $user->id]);
        }

        return redirect()->route('login')->with('success', 'Registration successful. Please login.');
    }

    public function showPinSetupForm($userId)
    {
        return view('setup_pin', ['userId' => $userId]);
    }

    public function setupPin(Request $request, $userId)
    {
        $request->validate([
            'pin' => 'required|digits:4'
        ]);

        $user = User::findOrFail($userId);
        $user->pin = Hash::make($request->pin);
        $user->save();

        return redirect()->route('login')->with('success', 'Registration successful. Please login.');
    }
}
