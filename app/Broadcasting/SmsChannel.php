<?php

namespace App\Broadcasting;

use App\Models\User;
use Twilio\Rest\Client;
use Twilio\Http\CurlClient;

class SmsChannel
{
    // protected $twilio;

    // public function __construct()
    // {
    //     $this->twilio = new Client(config('services.twilio.sid'), config('services.twilio.token'));
    // }

    // public function send($notifiable, $notification)
    // {
    //     $smsData = $notification->toSms($notifiable);

    //     $this->twilio->messages->create(
    //         $smsData['to'],
    //         [
    //             'from' => config('services.twilio.from'),
    //             'body' => $smsData['message'],
    //         ]
    //     );
    // }

    protected $twilio;

    public function __construct()
    {
        $twilioConfig = [
            'accountSid' => config('services.twilio.sid'),
            'authToken' => config('services.twilio.token'),
        ];

        $this->twilio = new Client(
            $twilioConfig['accountSid'],
            $twilioConfig['authToken'],
            null,
            null,
            new CurlClient([
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => false,
            ])
        );
    }

    public function send($notifiable, $notification)
    {
        $smsData = $notification->toSms($notifiable);

        $this->twilio->messages->create(
            $smsData['to'],
            [
                'from' => config('services.twilio.from'),
                'body' => $smsData['message'],
            ]
        );
    }
}
