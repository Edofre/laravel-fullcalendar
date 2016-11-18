# Laravel fullcalendar component

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

To install, either run

```
$ php composer.phar require edofre/laravel-fullcalendar
```

or add

```
"edofre/laravel-fullcalendar": "*"
```

to the ```require``` section of your `composer.json` file.

## Usage

### Fullcalender can be created as following, all options are optional, below is just an example of most options

Publish assets

php artisan vendor:publish --tag=fullcalendar --force

```php
'providers' => [
        ...
        Edofre\Fullcalendar\FullcalendarServiceProvider::class,
    ],
```

```php
'aliases' => [
        ...
        'Fullcalendar' => Edofre\Fullcalendar\Facades\Fullcalendar::class,
    ],
```

Render the calendar by generating the HMTL and scripts
```php
    {!! $calendar->generate() !!}
```