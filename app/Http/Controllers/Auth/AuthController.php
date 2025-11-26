<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman login
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Proses login
     */
    public function login(Request $request)
{
    $request->validate([
        'email'    => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($request->only('email', 'password'))) {

        $request->session()->regenerate();

        // Arahkan berdasarkan role
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->route('dashboard.admin');
        }

        if ($user->role === 'user') {
            return redirect()->route('dashboard.user');
        }

        // default jika role tidak dikenali
        return redirect()->route('dashboard');
    }

    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ])->withInput();
}


    /**
     * Dashboard setelah login
     */
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function adminDashboard()
    {
        return view('dashboard.admin');
    }

    public function userDashboard()
    {
        return view('dashboard.user');
    }


    /**
     * Logout user
     */
    public function logout(Request $request)
    {
        Auth::logout();

        // Destroy session lama
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Karena login page kamu ada di route '/'
        return redirect()->route('login');
    }
}
