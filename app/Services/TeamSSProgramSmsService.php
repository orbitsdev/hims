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
    protected string $apiUrl;

    public function __construct()
    {
        $this->apiSecret = config('services.teamssprogram.secret');
        $this->deviceId = config('services.teamssprogram.device_id');
        $this->sim = config('services.teamssprogram.sim', 1);
        $this->priority = config('services.teamssprogram.priority', 1);
        $this->apiUrl = "https://sms.teamssprogram.com/api/send/sms";
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
     * Send SMS using TeamSSProgram API
     */
    public function sendSms(string $number, string $message): array
    {
        try {
            $formattedNumber = $this->formatPhoneNumber($number);

            $payload = [
                "secret" => $this->apiSecret,
                "mode" => "devices",
                "device" => $this->deviceId,
                "sim" => $this->sim,
                "priority" => $this->priority,
                "phone" => $formattedNumber,
                "message" => $message,
            ];

            Log::info('TeamSSProgram SMS Request:', $payload);

            $response = Http::post($this->apiUrl, $payload);
            $responseData = $response->json();

            Log::info('TeamSSProgram SMS Response:', $responseData);

            return $responseData;
        } catch (\Exception $e) {
            Log::error('TeamSSProgram SMS Failed: ' . $e->getMessage());
            return [
                'error' => true,
                'message' => $e->getMessage(),
            ];
        }
    }
}
