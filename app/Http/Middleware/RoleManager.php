<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleManager
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $userRole = Auth::user()->role;
        
        if ($userRole === $role) {
            return $next($request);
        }

        // Redirect based on user's role
        switch ($userRole) {
            case 'admin':
                return redirect()->route('admin');
            case 'owner':
                return redirect()->route('owner.dashboard');
            case 'fleet_provider':
                return redirect()->route('fleet.dashboard');
            case 'customer':
                return redirect()->route('home');
            default:
                return redirect()->route('home');
        }
    }
}
