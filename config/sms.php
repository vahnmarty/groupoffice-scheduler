<?php

return [

    'provider' => env('SMS_PROVIDER', 'twilio'),

    'twilio' => [
        'sid' => env('TWILIO_SID'),
        'token' => env('TWILIO_TOKEN'),
    ],
];