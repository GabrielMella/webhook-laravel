<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Log;
use \Spatie\WebhookServer\Events\WebhookCallSucceededEvent;

class WebhookCallSucceededEventHandler
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function handle(WebhookCallSucceededEvent $event): void
    {
        Log::info('Webhook enviado com sucesso', [
            'event_id' => $event->uuid,
            'payload' => $event->payload,
        ]);
    }
}
