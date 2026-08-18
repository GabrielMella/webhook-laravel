<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        // Mass assignment protection is intentionally kept enabled.
        // Define $fillable or $guarded on each Eloquent model instead
        // of globally unguarding models via Model::unguard(), which
        // would expose the application to mass assignment vulnerabilities.
    }
}
