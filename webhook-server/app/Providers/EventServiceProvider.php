<?php

namespace App\Providers;

use App\Events\PaymentProcessed;
use App\Listeners\FinalWebhookCallSucceededEventHandler;
use App\Listeners\PaymentResponseNotification;
use App\Listeners\WebhookCallSucceededEventHandler;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Spatie\WebhookServer\Events\FinalWebhookCallFailedEvent;
use Spatie\WebhookServer\Events\WebhookCallSucceededEvent;

// <- there

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        PaymentProcessed::class => [
            PaymentResponseNotification::class,
        ],
        WebhookCallSucceededEvent::class => [
            WebhookCallSucceededEventHandler::class,
        ],
        FinalWebhookCallFailedEvent::class => [
            FinalWebhookCallSucceededEventHandler::class,
        ],
    ];
}
