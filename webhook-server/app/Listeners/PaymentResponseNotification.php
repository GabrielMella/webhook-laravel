<?php

namespace App\Listeners;

use App\Events\PaymentProcessed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Spatie\WebhookServer\WebhookCall;

class PaymentResponseNotification implements ShouldQueue
{
    public function handle(PaymentProcessed $event): void
    {
        Log::info('Enviando dados', [$event->payment_id]);

        WebhookCall::create()
            ->url(config('services.webhook_client.url'))
            ->payload([
                'id' => 12,
                'amount' => 10000,
                'currency' => 'EUR',
                'status' => 'success',
                'email' => 'jeremias@gmail.com',
                'reference' => $event->payment_id,
            ])
            ->useSecret(env('PAYSTACK_SECRET_KEY'))
            ->withHeaders([
                'x-paystack-signature' => 'webhook-client',
            ])
            ->dispatch();
    }
}
