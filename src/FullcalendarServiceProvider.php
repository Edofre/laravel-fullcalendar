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
        $this->loadViewsFrom(__DIR__ . '/views/', 'fullcalendar');


        //            __DIR__ . '/../../../bower/fullcalendar/dist/gcal.js.js'  => public_path('js/gcal.js'),

        $this->publishes([
            // Fullcalender library
            __DIR__ . '/../../../bower/fullcalendar/dist/fullcalendar.css'       => public_path('css/fullcalendar.css'),
            __DIR__ . '/../../../bower/fullcalendar/dist/fullcalendar.print.css' => public_path('css/fullcalendar.print.css'),
            __DIR__ . '/../../../bower/fullcalendar/dist/fullcalendar.js'        => public_path('js/fullcalendar.js'),
            __DIR__ . '/../../../bower/fullcalendar/dist/locale-all.js'          => public_path('js/locale-all.js'),
            // Moment library
            __DIR__ . '/../../../bower/moment/moment.js'                         => public_path('js/moment.js'),
        ], 'fullcalendar');
    }

    /**
     * @return array
     */
    public function provides()
    {
        return ['laravel-fullcalendar'];
    }
}