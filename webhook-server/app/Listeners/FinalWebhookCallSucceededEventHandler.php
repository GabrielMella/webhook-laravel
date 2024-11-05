<?php

namespace App\Listeners;

use Spatie\WebhookServer\Events\FinalWebhookCallFailedEvent;

class FinalWebhookCallSucceededEventHandler
{
    public function __construct()
    {
        //
    }

    public function handle(FinalWebhookCallFailedEvent $event)
    {
        logger(json_encode($event));
    }
}
