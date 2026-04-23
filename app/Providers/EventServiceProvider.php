<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        \App\Events\FormSubmitted::class => [
            \App\Listeners\SendSubmissionNotification::class,
        ],
    ];

    public function boot(): void
    {
        parent::boot();
    }
}