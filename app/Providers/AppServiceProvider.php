<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Ubah redirect default Breeze/Fortify setelah login
        \Illuminate\Support\Facades\Redirect::macro('intendedOrRole', function () {
            $user = Auth::user();

            if ($user) {
                if ($user->role === 'admin') {
                    return redirect()->route('admin.dashboard');
                } elseif ($user->role === 'hunter') {
                    return redirect()->route('hunter.dashboard');
                }
            }

            return redirect()->route('login');
        });
    }
}
