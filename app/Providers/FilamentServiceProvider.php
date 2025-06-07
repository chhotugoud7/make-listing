<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;


// class FilamentServiceProvider extends ServiceProvider
// {
//     public function boot(): void
//     {
//         Filament::serving(function () {
//             // ✅ Only run this if the user is authenticated
//             if (Auth::check()){
//                 if (!Auth::user()->is_admin) {
//                     abort(403, 'You are not authorized to access the admin panel.');
//                 }
//             }
//         });
//     }
// }




class FilamentServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Filament::serving(function () {
            
            Gate::define('viewFilament', function ($user) {
                return $user->is_admin; // allow only admin users
            });
        });
    }
}

