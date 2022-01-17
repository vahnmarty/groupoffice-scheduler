<?php

namespace App\Services;
use Twilio\Rest\Client;

class Sms {

    public $sid, $token, $from;

    public function __construct()
    {
        $this->sid = config('sms.twilio.sid');
        $this->token = config('sms.twilio.token');
        $this->from = "+19362514466";
    }

    public function send($number, $message)
    {
        $client = new Client($this->sid, $this->token);

        // Use the client to do fun stuff like send text messages!
        $client->messages->create(
            $number,
            [
                'from' => $this->from,
                'body' => $message
            ]
        );
    }

}