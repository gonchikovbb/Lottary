<?php

namespace App\Providers;

use App\Events\LotteryGameMatchEvent;
use App\Events\MatchUserEvent;
use App\Events\MatchUsersFullEvent;
use App\Events\MatchWinnerEvent;
use App\Listeners\LotteryGameMatchExecute;
use App\Listeners\MatchUserExecute;
use App\Listeners\MatchUsersFullExecute;
use App\Listeners\MatchWinnerExecute;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        MatchUserEvent::class => [
            MatchUserExecute::class,
        ],
        MatchUsersFullEvent::class => [
            MatchUsersFullExecute::class,
        ],
        MatchWinnerEvent::class => [
            MatchWinnerExecute::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
