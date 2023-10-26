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

    'google' => [
        'client_id' => '165580298161-jgjia2cgou5lutlvj16lm9ecuom20pvl.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'http://127.0.0.1:8000/callback/google',
    ],

    'stripe' => [
        'stripe_key' => 'pk_test_51LFO7TE1kCQ0YRV2u0jHjAQpqaJqZKi9mDU5kmSSRjcqukq7RHE0vYBxKewrDX39d1oUValUKXj9tcxLeo1Pp7o000uDmcWVeP',
        'stripe_secret' => 'sk_test_51LFO7TE1kCQ0YRV2v9SolJL3LCK6F7GwEmiBhT5uDhhdxrpH2nRq1tYZC5rAMswFhLY3m6YQU3TYAYdebkCaq1tX00wkxjomFs',
    ],

];
