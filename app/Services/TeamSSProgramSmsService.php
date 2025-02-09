<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TeamSSProgramSmsService
{
    protected string $apiSecret;
    protected string $deviceId;
    protected int $sim;
    protected int $priority;
    protected string $singleSmsUrl;

    public function __construct()
    {
        $this->apiSecret = config('services.teamssprogram.secret');
        $this->deviceId = config('services.teamssprogram.device_id');
        $this->sim = config('services.teamssprogram.sim', 1);
        $this->priority = config('services.teamssprogram.priority', 1);
        $this->singleSmsUrl = "https://sms.teamssprogram.com/api/send/sms";
    }

    /**
     * Format the phone number to the +63 standard
     */
    public function formatPhoneNumber(string $phone): string
    {
        $phone = preg_replace('/\D/', '', $phone); 
        if (substr($phone, 0, 1) === '9') {
            return '+63' . $phone;
        } elseif (substr($phone, 0, 2) === '09') {
            return '+63' . substr($phone, 1);
        } elseif (substr($phone, 0, 3) !== '+63') {
            return '+63' . $phone; 
        }
        return $phone; 
    }

    /**
     * Send Single SMS
     */
    public function sendSms(string $number, string $message): array
    {
        try {
            // Format phone number
            $formattedNumber = $this->formatPhoneNumber($number);

            // Prepare payload
            $payload = [
                "secret" => $this->apiSecret,
                "mode" => "devices",
                "device" => $this->deviceId,
                "sim" => $this->sim,
                "priority" => $this->priority,
                "phone" => $formattedNumber,
                "message" => $message,
            ];

            Log::info('Sending SMS with payload:', $payload);

            // Send request
            $response = Http::asForm()->post($this->singleSmsUrl, $payload);

            // Parse response
            $responseData = $response->json();

            Log::info('SMS Response:', $responseData);

            return $responseData;
        } catch (\Exception $e) {
            Log::error('Failed to send SMS: ' . $e->getMessage());
            return [
                'error' => true,
                'message' => $e->getMessage(),
            ];
        }
    }

    /**
     * Send Bulk SMS
     */
    public function sendBulkSms(array $numbers, string $message, string $campaign = "bulk_sms", array $groups = [])
    {
        try {
            $formattedNumbers = array_map([$this, 'formatPhoneNumber'], $numbers);
            $numberString = implode(',', $formattedNumbers);
            $groupString = implode(',', $groups);

            $payload = [
                "secret" => $this->apiSecret,
                "mode" => "devices",
                "campaign" => $campaign,
                "numbers" => $numberString,
                "groups" => $groupString,
                "device" => $this->deviceId,
                "sim" => $this->sim,
                "priority" => $this->priority,
                "message" => $message,
            ];

            Log::info('TeamSSProgram Bulk SMS Request:', $payload);

            $response = Http::asForm()->post($this->singleSmsUrl, $payload);

            $responseData = $response->json();

            Log::info('TeamSSProgram Bulk SMS Response:', $responseData);

            return $responseData;
        } catch (\Exception $e) {
            Log::error('TeamSSProgram Bulk SMS Failed: ' . $e->getMessage());
            return [
                'error' => true,
                'message' => $e->getMessage(),
            ];
        }
    }


    public function getPendingLogs(): array
{
    try {
        $url = "https://sms.teamssprogram.com/api/get/sms.pending?secret={$this->apiSecret}";
        $response = Http::get($url);
        $responseData = $response->json();

        Log::info('TeamSSProgram Pending Logs Response:', $responseData);

        return $responseData;
    } catch (\Exception $e) {
        Log::error('Fetching Pending Logs Failed: ' . $e->getMessage());
        return [
            'error' => true,
            'message' => $e->getMessage(),
        ];
    }
}

public function getSentLogs(): array
{
    try {
        $url = "https://sms.teamssprogram.com/api/get/sms.sent?secret={$this->apiSecret}";
        $response = Http::get($url);
        $responseData = $response->json();

        Log::info('TeamSSProgram Sent Logs Response:', $responseData);

        return $responseData;
    } catch (\Exception $e) {
        Log::error('Fetching Sent Logs Failed: ' . $e->getMessage());
        return [
            'error' => true,
            'message' => $e->getMessage(),
        ];
    }
}
}

