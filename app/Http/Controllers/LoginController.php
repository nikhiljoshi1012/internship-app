<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return $this->redirectBasedOnRole();
        }
        return view('login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput($request->except('password'));
        }

        $credentials = $request->only(['email', 'password']);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            if ($user->role === 'professor' && $user->pin) {
                return redirect()->route('verify.pin');
            }

            return $this->redirectBasedOnRole();
        }

        return back()
            ->withErrors(['email' => 'Invalid credentials'])
            ->withInput($request->except('password'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function showPinVerificationForm()
    {
        return view('verify_pin');
    }

    public function verifyPin(Request $request)
    {
        $request->validate([
            'pin' => 'required|digits:4'
        ]);

        $user = Auth::user();
        if (Hash::check($request->pin, $user->pin)) {
            return $this->redirectBasedOnRole();
        }

        return back()->withErrors(['pin' => 'Invalid PIN']);
    }

    private function redirectBasedOnRole()
    {
        $user = Auth::user();
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('professor.dashboard');
    }
}
