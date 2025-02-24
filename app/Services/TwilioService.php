<?php

namespace App\Services;

use Twilio\Rest\Client;

class TwilioService
{
    protected $twilio;
    
    public function __construct()
    {
        $sid = env('TWILIO_SID');
        $authToken = env('TWILIO_AUTH_TOKEN');
        $this->twilio = new Client($sid, $authToken);
    }

    // Método para enviar un SMS
    public function sendSms($to, $message)
    {
        $from = env('TWILIO_PHONE_NUMBER');
        $this->twilio->messages->create($to, [
            'from' => $from,
            'body' => $message,
        ]);
    }
}
