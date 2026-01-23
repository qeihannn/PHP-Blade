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
            'nis' => 'required|unique:users',
            'kelas' => 'required|max:15',
        ]);

        $user = User::create([
            'name' =>$request->name,
            'username' =>$request->username,
            'nis' => $request->nis,
            'kelas' => $request->kelas,
            'password' => bcrypt($request->password),
        ]);

            return redirect()->route('aspirasi.index')->with('success',
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
            return redirect()->route('aspirasi.index');
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
