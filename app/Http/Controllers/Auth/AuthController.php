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
                return redirect()->route('admin.dashboard'); // ⬅️ Update ini
            }

            if ($user->role === 'user') {
                return redirect()->route('user.dashboard'); // ⬅️ Update ini
            }

            // default jika role tidak dikenali
            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }

    /**
     * Dashboard umum
     */
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    /**
     * Dashboard ADMIN
     */
    public function adminDashboard()
    {
        return view('admin.dashboard');
    }

    /**
     * Dashboard USER
     */
    public function userDashboard()
    {
        return view('user.dashboard');
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

        return redirect()->route('login');
    }
}