<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();
    
        // Dapatkan pengguna yang terautentikasi
        $user = auth()->user();
    
        // Log untuk memeriksa role pengguna
        // Log::info('User logged in: ' . $user->id . ', Role: ' . $user->role);
    
        // Redirect berdasarkan role pengguna
        switch ($user->role) {
            case 'employee':
                return redirect()->route('home'); // Redirect untuk employee
            case 'admin':
                return redirect()->route('filament.admin.pages.dashboard'); // Redirect untuk admin
            case 'user': // Ganti dengan nama role yang tepat
                return redirect()->route('user.dashboard'); // Redirect untuk role user
            default:
                return redirect('/'); // Redirect ke halaman utama jika role tidak dikenali
        }
    }
    

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
