<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showUserLogin()
    {
        return view('auth.user-login');
    }

    public function showAdminLogin()
    {
        return view('auth.admin-login');
    }

    public function userLogin(Request $request)
    {
        $credentials = $request->validate([
            'npk' => ['required', 'numeric'],
            'password' => ['required'],
        ]);

        $credentials['role'] = 'user';

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'npk' => 'Login user gagal.',
        ])->onlyInput('npk');
    }

    public function adminLogin(Request $request)
    {
        $credentials = $request->validate([
            'npk' => ['required', 'numeric'],
            'password' => ['required'],
        ]);

        $credentials['role'] = 'admin';

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'npk' => 'Login admin gagal.',
        ])->onlyInput('npk');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
