<?php
return [
    'callback' => 'http://localhost:8080/?page=callback',
    'providers' => [
        'Google' => [
            'enabled' => true,
            'keys' => [
                'id' => 'REDACTED',
                'secret' => 'REDACTED'
            ],
        ],
        'Facebook' => [
            'enabled' => true,
            'keys' => [
                'id' => 'YOUR_FACEBOOK_APP_ID',
                'secret' => 'REDACTED'
            ],
        ],
    ],
];