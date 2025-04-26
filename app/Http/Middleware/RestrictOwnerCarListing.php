<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Car;

class RestrictOwnerCarListing
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        // Check if the user is an owner and already has a car listing
        if ($user && $user->isOwner() && Car::where('user_id', $user->id)->exists()) {
            return response()->json(['error' => 'Owners can only list one car.'], 403);
        }

        return $next($request);
    }
}
