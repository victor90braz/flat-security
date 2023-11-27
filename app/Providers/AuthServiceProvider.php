<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Flat;
use App\Models\User;
use Illuminate\Auth\Access\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->app->bind(Gate::class, function ($app) {
            return new \Illuminate\Auth\Access\Gate(
                $app,
                function () use ($app) {
                    return $app->make(\Illuminate\Contracts\Auth\Authenticatable::class);
                }
            );
        });

        $gate = app(Gate::class);
        $gate->define('update-flat', function (User $user, Flat $flat) {
            return $flat->user()->is($user);
        });

    }
}
