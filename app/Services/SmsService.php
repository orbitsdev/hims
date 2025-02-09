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
                'apikey' => $this->apiKey,  // Include the API key
                'number' => $number,
                'message' => $message,
                // 'sendername' => $this->senderName, // Optional sender name
            ];

            // Log the request payload
            Log::info('Semaphore SMS Request:', $payload);

            $response = Http::asForm() // Automatically sets 'Content-Type' to 'application/x-www-form-urlencoded'
                ->post('https://api.semaphore.co/api/v4/messages', $payload);

            $responseData = $response->json(); // Parse JSON response

            // Log the response
            Log::info('Semaphore SMS Response:', $responseData);

            return $responseData;
        } catch (\Exception $e) {
            Log::error('Semaphore SMS Failed: ' . $e->getMessage());
            return [
                'error' => true,
                'message' => $e->getMessage(),
            ];
        }
    }
}


 // $smsService = new SmsService();

    // // Hardcoded number for testing
    // $number = '+639366303145'; // Already formatted correctly for Semaphore
    // $message = $data['message']; // Message entered in the form
    
    // // Send the SMS
    // $response = $smsService->sendSms($number, $message);
    
    // // Log the response
    // \Log::info('SMS Response:', $response);
    
    // // Handle response
    // if (isset($response['error']) && $response['error']) {
    //     FilamentForm::notification('Failed to send SMS: ' . $response['message']);
    // } else {
    //     FilamentForm::notification('SMS sent successfully to ' . $number);
    // }