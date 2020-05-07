<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, SparkPost and others. This file provides a sane default
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */
    'google' => [
        'client_id' => '430792567154-380eem39h1kf65t3en19bse8f5a749pv.apps.googleusercontent.com',
        'client_secret' => 'wHONsTA6jewGlYFT4cOcphA-',
        'redirect' => 'https://www.agrishi.com/login/google/callback',
    ],
    'facebook' => [
        'client_id' => '578607166114980',
        'client_secret' => '6e8bb9ceef1e6ea05aab9c4ce155a61b',
        'redirect' => 'https://www.agrishi.com/login/facebook/callback',
    ],

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

];
