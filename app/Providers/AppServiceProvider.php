<?php

namespace App\Providers;

use App\Policies\ApartmentPolicy;
use App\Policies\UserPolicy;
use Illuminate\Support\ServiceProvider;
use App\Models\Booking;
use App\Models\User;
use App\Policies\BookingPolicy;
use Illuminate\Support\Facades\Gate;

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
        Gate::policy(Apartment::class, ApartmentPolicy::class);
        Gate::policy(Booking::class, BookingPolicy::class);
        Gate::policy(User::class, UserPolicy::class);
    }
}
