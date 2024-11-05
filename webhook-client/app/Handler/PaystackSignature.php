<?php

namespace App\Handler;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Spatie\WebhookClient\Exceptions\InvalidWebhookSignature;
use Spatie\WebhookClient\WebhookConfig;
use Spatie\WebhookClient\SignatureValidator\SignatureValidator;

class PaystackSignature implements SignatureValidator
{
    /**
     * @throws InvalidWebhookSignature
     */
    public function isValid(Request $request, WebhookConfig $config): bool
    {
        $signature = $request->header($config->signatureHeaderName);

        if (!$signature) {
            return false;
        }

        //Log::info('signature', [$signature]);

        //$signature = hash_hmac('sha512', $request->getContent(), $signature);

        $signingSecret = env('PAYSTACK_SECRET_KEY');

        if (empty($signingSecret)) {
            throw new InvalidWebhookSignature;
        }

        $computedSignature = hash_hmac('sha256', $request->getContent(), $signingSecret);

        return hash_equals($signature, $computedSignature);
    }
}
