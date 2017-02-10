# Laravel fullcalendar component

[![Latest Stable Version](https://poser.pugx.org/edofre/laravel-fullcalendar/v/stable)](https://packagist.org/packages/edofre/laravel-fullcalendar)
[![Total Downloads](https://poser.pugx.org/edofre/laravel-fullcalendar/downloads)](https://packagist.org/packages/edofre/laravel-fullcalendar)
[![Latest Unstable Version](https://poser.pugx.org/edofre/laravel-fullcalendar/v/unstable)](https://packagist.org/packages/edofre/laravel-fullcalendar)
[![License](https://poser.pugx.org/edofre/laravel-fullcalendar/license)](https://packagist.org/packages/edofre/laravel-fullcalendar)
[![composer.lock](https://poser.pugx.org/edofre/laravel-fullcalendar/composerlock)](https://packagist.org/packages/edofre/laravel-fullcalendar)

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

To install, either run

```
$ php composer.phar require edofre/laravel-fullcalendar
```

or add

```
"edofre/laravel-fullcalendar": "V1.0.7"
```

to the ```require``` section of your `composer.json` file.

### Note 
The fxp/composer-asset plugin is required for this package to install properly.
This plugin enables you to download bower packages through composer.

You can install it using this command:
```
composer global require "fxp/composer-asset-plugin:^1.2.0”
```

This will add the fxp composer-asset-plugin and your composer will be able to find and download the required bower-asset/fullcalendar package.
You can find more info on this page: [https://packagist.org/packages/fxp/composer-asset-plugin](https://packagist.org/packages/fxp/composer-asset-plugin).

## Configuration

Publish assets and configuration files
```
php artisan vendor:publish --tag=config
php artisan vendor:publish --tag=fullcalendar
```

Add the ServiceProvider to your config/app.php
```php
'providers' => [
        ...
        Edofre\Fullcalendar\FullcalendarServiceProvider::class,
    ],
```

And add the facade
```php
'aliases' => [
        ...
        'Fullcalendar' => Edofre\Fullcalendar\Facades\Fullcalendar::class,
    ],
```

### Example
Below is an example of a controller action configuring the calendar
```php
    public function index(\Illuminate\View\Factory $view)
    {
        // Generate a new fullcalendar instance
        $calendar = new \Edofre\Fullcalendar\Fullcalendar($view);

        // You can manually add the objects as an array
        $events = $this->getEvents();
        $calendar->setEvents($events);
        // Or you can add a route and return the events using an ajax requests that returns the events as json
        $calendar->setEvents(route('fullcalendar-ajax-events'));

        // Set options
        $calendar->setOptions([
            'locale'      => 'nl',
            'weekNumbers' => true,
            'selectable'  => true,
            'defaultView' => 'agendaWeek',
            // Add the callbacks
            'eventClick' => \Edofre\Fullcalendar\JsExpression("
                function(event, jsEvent, view) {
                    console.log(event);
                }
            "),
            'viewRender' => new \Edofre\Fullcalendar\JsExpression("
                function( view, element ) {
                    console.log(\"View \"+view.name+\" rendered\");
                }
            "),
        ]);

        // Check out the documentation for all the options and callbacks.
        // https://fullcalendar.io/docs/

        return view('fullcalendar.index', [
            'calendar' => $calendar,
        ]);
    }

    /**
     * @param Request $request
     * @return string
     */
    public function ajaxEvents(Request $request)
    {
        // start and end dates will be sent automatically by fullcalendar, they can be obtained using:
        // $request->get('start') & $request->get('end')
        $events = $this->getEvents();
        return json_encode($events);
    }

    /**
     * @return array
     */
    private function getEvents()
    {
        $events = [];
        $events[] = new \Edofre\Fullcalendar\Event([
            'id'     => 0,
            'title'  => 'Rest',
            'allDay' => true,
            'start'  => Carbon::create(2016, 11, 20),
            'end'    => Carbon::create(2016, 11, 20),
        ]);

        $events[] = new \Edofre\Fullcalendar\Event([
            'id'    => 1,
            'title' => 'Appointment #' . rand(1, 999),
            'start' => Carbon::create(2016, 11, 15, 13),
            'end'   => Carbon::create(2016, 11, 15, 13)->addHour(2),
        ]);

        $events[] = new \Edofre\Fullcalendar\Event([
            'id'               => 2,
            'title'            => 'Appointment #' . rand(1, 999),
            'editable'         => true,
            'startEditable'    => true,
            'durationEditable' => true,
            'start'            => Carbon::create(2016, 11, 16, 10),
            'end'              => Carbon::create(2016, 11, 16, 13),
        ]);

        $events[] = new \Edofre\Fullcalendar\Event([
            'id'               => 3,
            'title'            => 'Appointment #' . rand(1, 999),
            'editable'         => true,
            'startEditable'    => true,
            'durationEditable' => true,
            'start'            => Carbon::create(2016, 11, 14, 9),
            'end'              => Carbon::create(2016, 11, 14, 10),
            'backgroundColor'  => 'black',
            'borderColor'      => 'red',
            'textColor'        => 'green',
        ]);
        return $events;
    }
```


You can then render the calendar by generating the HMTL and scripts
```php
    {!! $calendar->generate() !!}
```
