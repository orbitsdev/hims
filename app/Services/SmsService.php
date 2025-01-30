<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SmsService
{
    protected string $apiKey;
    protected string $senderName;

    public function __construct()
    {
        $this->apiKey = config('services.semaphore.api_key');
        $this->senderName = config('services.semaphore.sender_name');
    }

    /**
     * Send SMS via Semaphore API
     *
     * @param string $number The recipient's phone number
     * @param string $message The message to send
     * @return array
     */
    public function sendSms(string $number, string $message): array
    {
        try {
            $payload = [
                'apikey' => $this->apiKey,
                'number' => $number,
                'message' => $message,
                'sendername' => $this->senderName,
            ];
    
            // Log the request
            \Log::info('Semaphore SMS Request:', $payload);
    
            $response = Http::post('https://semaphore.co/api/v4/messages', $payload);
    
            // Log the response
            \Log::info('Semaphore SMS Response:', $response->json());
    
            return $response->json();
        } catch (\Exception $e) {
            \Log::error('Semaphore SMS Failed: ' . $e->getMessage());
            return [
                'error' => true,
                'message' => $e->getMessage(),
            ];
        }
    }
}
