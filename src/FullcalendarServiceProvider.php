<?php

namespace Edofre\Fullcalendar;

use Illuminate\Support\ServiceProvider;

/**
 * Class FullcalendarServiceProvider
 * @package Edofre\Fullcalendar
 */
class FullcalendarServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('laravel-fullcalendar', function ($app) {
            return $app->make(Fullcalendar::class);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/vendor/bower/fullcalendar/dist/' => public_path('js/courier'),
        ], 'public');
    }
}