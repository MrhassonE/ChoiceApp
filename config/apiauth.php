<?php

return [
    'services' => [
        'APIAuth' => [
            'token' => env('MY_APP_TOKEN'),
            'tokenName' => 'api_token',

            'allowJsonToken' => true,
            'allowBearerToken' => true,
            'allowRequestToken' => true,
        ]
    ],
];
