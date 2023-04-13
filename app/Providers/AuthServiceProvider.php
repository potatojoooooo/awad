<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Service::class => ServicePolicy::class,
        User::class => UserPolicy::class,
        Booking::class => BookingPolicy::class,
    ];
    

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('manage-services', function ($admin) {
            return $admin->isAdmin();
        });
    
        Gate::define('manage-users', function ($admin) {
            return $admin->isAdmin();
        });
    
        Gate::define('manage-bookings', function ($admin) {
            return $admin->isAdmin();
        });

        Gate::define('delete-service', function ($admin, $service) {
            return $admin->can('manage-services');
        });
    }
}
