<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'App\Events\ProductDeleteEvent' => [
            'App\Listeners\ProductDeleteListener',
        ],
        'App\Events\CasesDeleteEvent' => [
            'App\Listeners\CasesDeleteListener',
        ],
        'App\Events\BannersDeleteEvent' => [
            'App\Listeners\BannersDeleteListener',
        ],
        'App\Events\BanneritemDeleteEvent' => [
            'App\Listeners\BanneritemDeleteListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
