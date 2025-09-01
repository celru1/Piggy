<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAccessingWrongDashboard
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login'); // Or your login route
        }

        $role = auth()->user()->role;
        $uri = $request->path();

        //  If user is 'user' but trying to access admin dashboard
        if ($role === 'user' && str_contains($uri, 'admin-dashboard')) {
            return redirect()->route('filament.boar-sync.pages.dashboard');
        }

        // If user is 'admin' but trying to access user dashboard
        if ($role === 'admin' && str_contains($uri, 'dashboard') && !str_contains($uri, 'admin-dashboard')) {
            return redirect()->route('filament.boar-sync.pages.admin-dashboard');
        }

        return $next($request);
    }
}
