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


    public function sendBulkSmsWithDelay(array $numbers, string $message, int $delaySeconds = 5): array
{
    $responses = [];

    try {
        // ✅ Ensure all phone numbers are correctly formatted
        $formattedNumbers = array_map([$this, 'formatPhoneNumber'], $numbers);

        foreach ($formattedNumbers as $index => $number) {
            // ✅ API requires `phone`, not `numbers`
            $payload = [
                "secret" => $this->apiSecret,
                "mode" => "devices",
                "device" => $this->deviceId,
                "sim" => (string) $this->sim, // Ensure it's a string
                "priority" => "1", // Ensure it's a string
                "phone" => $number, // ✅ Correct field name (previously `numbers`)
                "message" => $message
            ];

            Log::info("Sending SMS to: {$number}", ['payload' => $payload]);

            // ✅ Use Laravel `Http::asForm()` instead of cURL for consistency
            $response = Http::asForm()->post($this->singleSmsUrl, $payload);
            $responseData = $response->json();

            $responses[$number] = $responseData;

            Log::info("SMS Response for {$number}", ['response' => $responseData]);

            // ✅ Add delay only if not the last number
            if ($index < count($formattedNumbers) - 1) {
                sleep($delaySeconds);
            }
        }
    } catch (\Exception $e) {
        Log::error('Bulk SMS Failed: ' . $e->getMessage());
        return [
            'error' => true,
            'message' => $e->getMessage(),
        ];
    }

    return $responses;
}


//     public function sendBulkSmsWithDelay(array $numbers, string $message, int $delaySeconds = 3): array
// {
//     $responses = [];

//     // ✅ Ensure all phone numbers are correctly formatted
//     $formattedNumbers = array_map([$this, 'formatPhoneNumber'], $numbers);
//     // dd($formattedNumbers);

//     // ✅ Debugging: Ensure all numbers are in "+63XXXXXXXXXX" format
//     Log::info('Formatted Phone Numbers', ['numbers' => $formattedNumbers]);

//     foreach ($formattedNumbers as $index => $number) {
//         try {
//             $payload = [
//                 "secret" => $this->apiSecret,
//                 "mode" => "devices",
//                 "device" => $this->deviceId,
//                 "sim" => $this->sim,
//                 "priority" => 1,
//                 "phone" => $number, // ✅ Use correctly formatted number
//                 "message" => $message
//             ];

//             Log::info("Sending SMS to: {$number}", ['payload' => $payload]);

//             // ✅ Send each message to single SMS URL
//             $response = Http::asForm()->post($this->singleSmsUrl, $payload);
//             $responseData = $response->json();

//             $responses[$number] = $responseData;

//             Log::info("SMS Response for {$number}", ['response' => $responseData]);

//             // ✅ Add delay only if there are more numbers left
//             if ($index < count($formattedNumbers) - 1) {
//                 sleep($delaySeconds);
//             }
//         } catch (\Exception $e) {
//             Log::error("Failed to send SMS to {$number}", ['error' => $e->getMessage()]);
//             $responses[$number] = ['error' => true, 'message' => $e->getMessage()];
//         }
//     }

//     return $responses;
// }




// <?php
// function sendSMS($number, $message, $apiSecret, $device, $sim = 1) {
//     $payload = [
//         "secret" => $apiSecret,
//         "mode" => "devices",
//         "device" => $device,
//         "sim" => $sim,
//         "priority" => 1,
//         "numbers" => $number,
//         "message" => $message
//     ];

//     $cURL = curl_init("https://sms.teamssprogram.com/api/send/sms.bulk");
//     curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
//     curl_setopt($cURL, CURLOPT_POSTFIELDS, $payload);
//     $response = curl_exec($cURL);
//     curl_close($cURL);

//     return json_decode($response, true);
// }

// // Configuration
// $apiSecret = "YOUR_API_SECRET"; // Replace with your actual API secret
// $device = "00000000-0000-0000-d57d-f30cb6a89289"; // Replace with your device ID
// $message = "Hello World!";
// $delaySeconds = 3; // Delay between each SMS in seconds

// // Numbers to send SMS to
// $numbers = [
//     "+639051234567",
//     "+639123456789",
//     "+639123456789"
// ];

// // Send SMS to each number with delay
// foreach ($numbers as $index => $number) {
//     // Send SMS
//     $result = sendSMS($number, $message, $apiSecret, $device);

//     // Log the result
//     echo "Sending to $number: ";
//     print_r($result);
//     echo "\n";

//     // Add delay if this is not the last number
//     if ($index < count($numbers) - 1) {
//         sleep($delaySeconds);
//     }
// }




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


