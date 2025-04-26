<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Determine where to redirect users after authentication.
     */
    public function redirectTo(): string
    {
        if (Auth::check()) {
            $user = Auth::user();
            
            switch ($user->role) {
                case 'admin':
                    return route('admin');
                case 'owner':
                    return route('owner.dashboard');
                case 'fleet_provider':
                    return route('fleet.dashboard');
                case 'customer':
                    return route('home');
                default:
                    return self::HOME;
            }
        }

        return self::HOME;
    }
}
