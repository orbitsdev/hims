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
    protected string $bulkSmsUrl;
    protected string $pendingLogsUrl;
    protected string $sentLogsUrl;

    public function __construct()
    {
        $this->apiSecret = config('services.teamssprogram.secret');
        $this->deviceId = config('services.teamssprogram.device_id');
        $this->sim = config('services.teamssprogram.sim', 1);
        $this->priority = config('services.teamssprogram.priority', 1);

        $this->singleSmsUrl = "https://sms.teamssprogram.com/api/send/sms";
        $this->bulkSmsUrl = "https://sms.teamssprogram.com/api/send/sms.bulk";
        $this->pendingLogsUrl = "https://sms.teamssprogram.com/api/get/sms.pending";
        $this->sentLogsUrl = "https://sms.teamssprogram.com/api/get/sms.sent";
    }

    /**
     * Format the phone number to the +63 standard
     */
    public function formatPhoneNumber(string $phone): string
{

    $phone = preg_replace('/\D/', '', $phone);


    if (substr($phone, 0, 2) === '09') {
        return '+63' . substr($phone, 1);
    }


    if (substr($phone, 0, 1) === '9') {
        return '+63' . $phone;
    }


    if (substr($phone, 0, 3) === '+63') {
        return $phone;
    }


    Log::error('Invalid phone number format: ' . $phone);
    return $phone;
}


    /**
     * Send Single SMS
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

            Log::info('Sending SMS with payload:', $payload);

            $response = Http::asForm()->post($this->singleSmsUrl, $payload);

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
    public function sendBulkSms(array $numbers, string $message, string $campaign = "bulk_sms", array $groups = []): array
    {
        try {
            $formattedNumbers = array_map([$this, 'formatPhoneNumber'], $numbers);
            $numberString = implode(',', $formattedNumbers); // Comma-separated string
            $groupString = implode(',', $groups); // Optional groups

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

            Log::info('Bulk SMS Payload:', $payload);


            $response = Http::asForm()->post($this->bulkSmsUrl, $payload);

            $responseData = $response->json();

            Log::info('Bulk SMS Response:', $responseData);

            return $responseData;
        } catch (\Exception $e) {
            Log::error('Bulk SMS Failed: ' . $e->getMessage());
            return [
                'error' => true,
                'message' => $e->getMessage(),
            ];
        }
    }

    public function sendBulkSmsWithDelay(array $numbers, string $message, int $delaySeconds = 3): array
{
    $responses = [];
    $formattedNumbers = implode(',', array_map([$this, 'formatPhoneNumber'], $numbers)); // Format numbers properly

    foreach (explode(',', $formattedNumbers) as $index => $number) {
        try {
            $payload = [
                "secret" => $this->apiSecret,
                "mode" => "devices",
                "device" => $this->deviceId,
                "sim" => $this->sim,
                "priority" => 1,
                "numbers" => $number, // Now correctly formatted
                "message" => $message
            ];

            Log::info("Sending SMS to: {$number} | Payload: ", $payload);

            $response = Http::asForm()->post($this->bulkSmsUrl, $payload);
            $responseData = $response->json();

            $responses[$number] = $responseData;

            Log::info("SMS Response for {$number}: ", $responseData);

            // Add delay before sending the next message
            if ($index < count($numbers) - 1) {
                sleep($delaySeconds); // Wait for X seconds before next SMS
            }
        } catch (\Exception $e) {
            Log::error("Failed to send SMS to {$number}: " . $e->getMessage());
            $responses[$number] = ['error' => true, 'message' => $e->getMessage()];
        }
    }

    return $responses;
}





    /**
     * Fetch Pending Logs
     */
    public function getPendingLogs(): array
    {
        try {
            $url = "{$this->pendingLogsUrl}?secret={$this->apiSecret}";
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

    /**
     * Fetch Sent Logs
     */
    public function getSentLogs(): array
    {
        try {
            $url = "{$this->sentLogsUrl}?secret={$this->apiSecret}";
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
