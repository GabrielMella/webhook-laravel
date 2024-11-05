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
        $data = $dat['payload'];

        Log::info('Recebendo dados', $data);

        if (!empty($data['email'])) {
            Mail::to($data['email'])->send(new SendEmail());
        }

        http_response_code(200);
    }
}
