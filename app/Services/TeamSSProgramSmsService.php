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

    public function __construct()
    {
        $this->apiSecret = config('services.teamssprogram.secret');
        $this->deviceId = config('services.teamssprogram.device_id');
        $this->sim = config('services.teamssprogram.sim', 1);
        $this->priority = config('services.teamssprogram.priority', 1);
        $this->singleSmsUrl = "https://sms.teamssprogram.com/api/send/sms";
        $this->bulkSmsUrl = "https://sms.teamssprogram.com/api/send/sms.bulk";
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

            Log::info('TeamSSProgram Single SMS Request:', $payload);

            $response = Http::post($this->singleSmsUrl, $payload);
            $responseData = $response->json();

            Log::info('TeamSSProgram Single SMS Response:', $responseData);

            return $responseData;
        } catch (\Exception $e) {
            Log::error('TeamSSProgram SMS Failed: ' . $e->getMessage());
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

            $response = Http::post($this->bulkSmsUrl, $payload);
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
}


// <!-- <?php

//   $message = [
//       "secret" => "API_SECRET", // your API secret from (Tools -> API Keys) page
//       "mode" => "devices",
//       "device" => "00000000-0000-0000-d57d-f30cb6a89289",
//       "sim" => 1,
//       "priority" => 1,
//       "phone" => "+639051234567",
//       "message" => "Hello World!"
//   ];

//   $cURL = curl_init("https://sms.teamssprogram.com/api/send/sms");
//   curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
//   curl_setopt($cURL, CURLOPT_POSTFIELDS, $message);
//   $response = curl_exec($cURL);
//   curl_close($cURL);

//   $result = json_decode($response, true);

//   // do something with response
//   print_r($result);
// Success Response
// {
//   "status": 200,
//   "message": "Message has been queued for sending!",
//   "data": false
// }
// Error Response
// {
//   "status": 400,
//   "message": "Invalid Parameters!",
//   "data": false
// }
// sms.teamssprogram.com
// Charlz
// Lamera D Charlz
// ari if bulk 
// Charlz
// Lamera D Charlz
// <?php

//   $message = [
//       "secret" => "API_SECRET", // your API secret from (Tools -> API Keys) page
//       "mode" => "devices",
//       "campaign" => "bulk test",
//       "numbers" => "+639051234567,+639123456789,+639123456789",
//       "groups" => "1,2,3,4",
//       "device" => "00000000-0000-0000-d57d-f30cb6a89289",
//       "sim" => 1,
//       "priority" => 1,
//       "message" => "Hello World!"
//   ];

//   $cURL = curl_init("https://sms.teamssprogram.com/api/send/sms.bulk");
//   curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
//   curl_setopt($cURL, CURLOPT_POSTFIELDS, $message);
//   $response = curl_exec($cURL);
//   curl_close($cURL);

//   $result = json_decode($response, true);

//   // do something with response
//   print_r($result);
// Success Response
// {
//   "status": 200,
//   "message": "Message has been queued for sending!",
//   "data": false
// }
// Error Response
// {
//   "status": 400,
//   "message": "Invalid Parameters!",
//   "data": false
// }
// sms.teamssprogram.com
// Charlz replied to you
// amo na abeh sa api code nya 
// Charlz
// Lamera D Charlz
// no need na sa api nana nga value  -->