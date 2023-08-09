<?php

return [

    'credentials' => [
        'secret_token' => env('ZOOM_SECRET_TOKEN'),
        'verification_token' => env('ZOOM_VERIFICATION_TOKEN'),
        'account_id' => env('ZOOM_API_ACCOUNT_ID'),
        'client_id' => env('ZOOM_API_CLIENT_ID'),
        'client_secret' => env('ZOOM_API_SECRET'),
        'api_key' => env('ZOOM_API_KEY'),
        'redirect' => env('ZOOM_API_ACCOUNT_ID'),
    ],
];
