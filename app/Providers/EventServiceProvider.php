<?php

namespace App\Providers;

use App\Events\SeriesCreated;
use App\Listeners\EmailUsersAboutSeriesCreated;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;

class EventServiceProvider extends ServiceProvider
{
    // protected $listen = [
    //     SeriesCreated::class => [
    //         EmailUsersAboutSeriesCreated::class,
    //     ],
    // ];

    // public function boot(): void
    // {
         
    // }
}
