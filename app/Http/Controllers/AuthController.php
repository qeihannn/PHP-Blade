<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller {
    public function showRegisterForm() {
        $title = 'Register';
        return view('auth.register', compact('title'));
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255|unique:users',
            'password' => 'required|min:6|max:32|confirmed',
        ]);

        $user = User::create([
            'name' =>$request->name,
            'username' =>$request->username,
            'password' => bcrypt($request->password),
        ]);

            return redirect()->route('login')->with('success',
            'Registrasi berhasil');
    }

    public function showLoginForm() {
        $title = 'Login';
        return view('auth.login', compact('title'));
    }

    public function login(Request $request) {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();
            return redirect()->route('tickets.index');
        }

        return back()->withErrors(['username' => 'Username atau password salah']);
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Logout berhasil.');
    }

}
