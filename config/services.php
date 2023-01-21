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
    'pusher' => [
        'beams_instance_id' => '017ef162-f750-4961-9aee-6e73e1d7299e',
        'beams_secret_key' => 'CBC1D1A96D731C80F75706C039FBC8BC3FA00E68F9533B3D14115536FF39702A',
    ],
    'google' => [
        'client_id' => '257549371109-dkq2tc5jpp7id65uodpgfvk56j3dioc3.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'http://tamqa.net/api/socialite',
    ],

];
