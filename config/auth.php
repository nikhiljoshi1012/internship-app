<?php

return [
    'defaults' => [
        'guard' => 'professor',
        'passwords' => 'professors',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'professor' => [
            'driver' => 'session',
            'provider' => 'professors',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
        'professors' => [
            'driver' => 'eloquent',
            'model' => App\Models\Professor::class,
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
        'professors' => [
            'provider' => 'professors',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],
];
