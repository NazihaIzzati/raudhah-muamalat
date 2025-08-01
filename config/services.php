<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'cardzone' => [
        'production' => env('CARDZONE_PRODUCTION', false),
        'uat' => env('CARDZONE_UAT', false),
        'sandbox_url' => env('CARDZONE_SANDBOX_URL', 'https://3dsecureczuat.muamalat.com.my/3dss/'),
        'uat_url' => env('CARDZONE_UAT_URL', 'https://3dsecureczuat.muamalat.com.my/3dss/'),
        'production_url' => env('CARDZONE_PRODUCTION_URL', 'https://3dsecurecz.muamalat.com.my/3dss/'),
        'merchant_id' => env('CARDZONE_MERCHANT_ID', '400000000000005'),
        'merchant_password' => env('CARDZONE_MERCHANT_PASSWORD'),
        'terminal_id' => env('CARDZONE_TERMINAL_ID'),
    ],

];
