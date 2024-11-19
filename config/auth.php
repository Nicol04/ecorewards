<?php

return [

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'usuario'),
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'usuario',
        ],
    ],

    'providers' => [
        'usuario' => [
            'driver' => 'eloquent',
            'model' => env('AUTH_MODEL', App\Models\Usuario::class),
        ],

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

    'passwords' => [
        'usuario' => [
            'provider' => 'usuario',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];
