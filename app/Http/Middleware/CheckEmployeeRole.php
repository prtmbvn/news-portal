<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class CheckEmployeeRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Pastikan pengguna terautentikasi dan memiliki role 'employee'
        if (!auth()->check()) {
            return redirect('/'); // Redirect ke halaman utama jika tidak terautentikasi
        }

        Log::info('Current user role: ' . auth()->user()->role);

        if (auth()->user()->role !== 'employee') {
            return redirect('/'); // Redirect ke halaman utama jika bukan employee
        }


        return $next($request);
    }
}
