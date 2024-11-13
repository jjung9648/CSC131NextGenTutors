<?php
return [
    'callback' => 'http://localhost:8080/?page=callback',
    'providers' => [
        'Google' => [
            'enabled' => true,
            'keys' => [
               'id' => $_ENV['GOOGLE_CLIENT_ID'],
                'secret' => $_ENV['GOOGLE_CLIENT_SECRET']
            ],
        ],
        'Facebook' => [
            'enabled' => true,
            'keys' => [
                'id' => $_ENV['FACEBOOK_APP_ID'],
                'secret' => $_ENV['FACEBOOK_APP_SECRET']
            ],
        ],
    ],
];