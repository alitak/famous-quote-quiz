<?php

namespace App\Providers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Artisan::command('logs:clear', function () {
            exec('echo "" > ' . storage_path('logs/laravel.log'));
            $this->comment('Logs have been cleared!');
        })->describe('Clear log files');
    }
}
