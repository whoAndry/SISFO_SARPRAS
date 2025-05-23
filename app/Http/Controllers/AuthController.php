<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // ✅ Tampilkan halaman register
    public function showRegister()
    {
        return view('register');
    }

    // ✅ Proses data register
    public function register(Request $request)
    {
        // Validasi form input
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        // Simpan user baru ke database
        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Redirect ke login setelah register sukses
        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // ✅ Tampilkan halaman login
    public function showLogin()
    {
        return view('login');
    }

    // ✅ Proses login
    public function login(Request $request)
    {
        // Validasi form input login
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        // Coba login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Cegah session fixation
            return redirect()->intended('/home');
        }

        // Gagal login
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    // ✅ Logout user
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function actionlogin(Request $request)
{
    $email = $request->email;
    $password = $request->password;

    if (Auth::attempt(['email' => $email, 'password' => $password])) {
        // Jika login berhasil, redirect ke home
        return redirect()->route('home');
    } else {
        // Jika gagal, kembali ke login dengan error
        return redirect()->back()->withErrors('Email atau password salah.');
    }
}
}
