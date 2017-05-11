<?php

namespace Edofre\Fullcalendar;

use Illuminate\Support\ServiceProvider;

/**
 * Class FullcalendarServiceProvider
 * @package Edofre\Fullcalendar
 */
class FullcalendarServiceProvider extends ServiceProvider
{
    /** Identifier for the service */
    const IDENTIFIER = 'laravel-fullcalendar';

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(self::IDENTIFIER, function ($app) {
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
        // specify from where we want to load the views
        $this->loadViewsFrom(__DIR__ . '/views/', 'fullcalendar');

        // publish the config file
        $this->publishes([
            __DIR__ . '/config/fullcalendar.php' => config_path('fullcalendar.php'),
        ], 'config');

        // publish all the required files to generate the calendar
        $this->publishes([
            // fullcalendar library
            __DIR__ . '/../../../bower-asset/fullcalendar/dist/fullcalendar.css'       => public_path('css/fullcalendar.css'),
            __DIR__ . '/../../../bower-asset/fullcalendar/dist/fullcalendar.print.css' => public_path('css/fullcalendar.print.css'),
            __DIR__ . '/../../../bower-asset/fullcalendar/dist/fullcalendar.js'        => public_path('js/fullcalendar.js'),
            __DIR__ . '/../../../bower-asset/fullcalendar/dist/locale-all.js'          => public_path('js/locale-all.js'),
            __DIR__ . '/../../../bower-asset/fullcalendar/dist/gcal.js'                => public_path('js/gcal.js'),
            // moment library
            __DIR__ . '/../../../bower-asset/moment/moment.js'                         => public_path('js/moment.js'),
        ], 'fullcalendar');
    }

    /**
     * @return array
     */
    public function provides()
    {
        return [self::IDENTIFIER];
    }
}