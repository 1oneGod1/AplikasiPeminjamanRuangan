<?php

namespace App\Services;

use App\Exceptions\EmailJsException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class EmailJsService
{
    protected ?string $publicKey;
    protected ?string $privateKey;
    protected ?string $serviceId;
    protected ?string $userId;

    public function __construct()
    {
        $this->publicKey = config('services.emailjs.public_key');
        $this->privateKey = config('services.emailjs.private_key');
        $this->serviceId = config('services.emailjs.service_id');
        $this->userId = config('services.emailjs.user_id');
    }

    /**
     * Send an email using EmailJS.
     */
    public function send(string $templateId, array $templateParams): Response
    {
        $this->ensureConfigured();

        $payload = [
            'service_id' => $this->serviceId,
            'template_id' => $templateId,
            'user_id' => $this->userId,
            'accessToken' => $this->privateKey,
            'template_params' => $templateParams,
        ];

        $response = Http::timeout(10)->post('https://api.emailjs.com/api/v1.0/email/send', $payload);

        if ($response->failed()) {
            $body = $response->json();
            $message = $body['error'] ?? $response->body() ?: 'EmailJS request failed';

            Log::error('EmailJS request failed', [
                'status' => $response->status(),
                'error' => $message,
                'payload' => array_merge(
                    collect($payload)
                        ->except(['accessToken'])
                        ->toArray(),
                    ['template_params' => $templateParams]
                ),
            ]);

            throw new EmailJsException($message, [
                'status' => $response->status(),
                'body' => $body,
            ]);
        }

        Log::info('EmailJS request sent', [
            'template_id' => $templateId,
            'status' => $response->status(),
            'to_email' => $templateParams['to_email'] ?? null,
        ]);

        return $response;
    }

    protected function ensureConfigured(): void
    {
        if (! $this->serviceId || ! $this->privateKey || ! $this->userId) {
            throw new EmailJsException('EmailJS credentials are missing.', [
                'service_id' => (bool) $this->serviceId,
                'private_key' => (bool) $this->privateKey,
                'user_id' => (bool) $this->userId,
            ]);
        }
    }
}
