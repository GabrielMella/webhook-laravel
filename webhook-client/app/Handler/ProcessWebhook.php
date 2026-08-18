<?php

namespace App\Handler;

use App\Mail\SendEmail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Spatie\WebhookClient\Jobs\ProcessWebhookJob;

class ProcessWebhook extends ProcessWebhookJob
{
    public function handle(): void
    {
        $dat = json_decode($this->webhookCall, true);

        if (!is_array($dat) || !isset($dat['payload']) || !is_array($dat['payload'])) {
            Log::warning('Payload do webhook inválido ou ausente');
            http_response_code(422);
            return;
        }

        $data = $dat['payload'];

        Log::info('Recebendo dados', $data);

        if (isset($data['email']) && filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            Mail::to($data['email'])->send(new SendEmail());
        } elseif (isset($data['email'])) {
            Log::warning('Email inválido recebido no webhook');
        }

        http_response_code(200);
    }
}
