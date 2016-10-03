<?php

namespace Vitorbar\Users;

use Illuminate\Support\ServiceProvider;

class UsersServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // routes

        include __DIR__.'/routes.php';

        // migrations

        $this->publishes([
            __DIR__.'/migrations/' => database_path('/migrations')
        ], 'migrations');

        // assets

        $this->publishes([
            __DIR__.'/resources/assets' => public_path('vendor/users'),
        ], 'assets');

        // views

        $this->loadViewsFrom(__DIR__.'/views', 'users');

        $this->publishes([
            __DIR__.'/resources/views' => base_path('resources/views/vendor/users'),
        ], 'views');

        if(config('app.debug')) {
            \Artisan::call('vendor:publish', [
                '--tag' => 'views',
                '--force' => true
            ]);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
