<?php

namespace App\\Services;

use Illuminate\\Support\\Facades\\Http;
use RuntimeException;

class BwmMailService
{
    /**
     * Send a transactional email through BWM Mail API.
     *
     * Configure BWM_MAIL_API_URL and BWM_MAIL_API_KEY in the server .env.
     */
    public function send(array $message): array
    {
        $endpoint = config('services.bwm_mail.url');
        $apiKey = config('services.bwm_mail.key');

        if (!$endpoint || !$apiKey) {
            throw new RuntimeException('BWM Mail API configuration is missing.');
        }

        $response = Http::acceptJson()
            ->asJson()
            ->withToken($apiKey)
            ->timeout(30)
            ->post($endpoint, $message);

        if ($response->failed()) {
            throw new RuntimeException(
                'BWM Mail API returned HTTP ' . $response->status() . ': ' .
                $response->body()
            );
        }

        return $response->json() ?? [];
    }
}

/*
Add to config/services.php:

'bwm_mail' => [
    'url' => env('BWM_MAIL_API_URL'),
    'key' => env('BWM_MAIL_API_KEY'),
],

Then add these server-side values to .env (never commit .env):

BWM_MAIL_API_URL=https://YOUR_BWM_MAIL_API_HOST/api/v1/send
BWM_MAIL_API_KEY=YOUR_API_KEY

Example call:

app(\\App\\Services\\BwmMailService::class)->send([
    'to' => 'recipient@example.com',
    'subject' => 'Welcome',
    'html' => '<h1>Welcome!</h1>',
]);
*/
