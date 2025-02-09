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


getUserPhoneNumber($con, $email)
{
    $stmt = $con->prepare("SELECT mobile FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $user_data = $stmt->get_result()->fetch_assoc();
    return $user_data['mobile'] ?? null;
}

function formatPhoneNumber($phone)
{
    // Remove non-digits and format to +63 standard
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

function send_sms_notification($phone, $message)
{
    $sms_data = [
        "secret" => "beebe0d24fc6f54007cafd3b07ff3a78f6d1900d",
        "mode" => "devices",
        "device" => "00000000-0000-0000-d0b4-cb76e31aa544",
        "sim" => 1,
        "priority" => 1,
        "phone" => $phone,
        "message" => $message,
    ];

    $cURL = curl_init("https://sms.teamssprogram.com/api/send/sms");
    curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($cURL, CURLOPT_POSTFIELDS, $sms_data);
    $response = curl_exec($cURL);
    curl_close($cURL);

    $result = json_decode($response, true);

    if ($result['status'] != 200) {
        error_log("SMS sending failed: " . $result['message']);
    }
}
sms.teamssprogram.com