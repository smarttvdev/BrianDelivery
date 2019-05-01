<?php

return [
    'defaults' => [
        'guard' => 'admin',
        'passwords' => 'admin',
    ],

    'guards' => [
        'admin' => [
            'driver' => 'session',
            'provider' => 'admin',
        ],

        'api' => [
            'driver' => 'passport',
            'provider' => 'user',
        ],
        'user' => [
            'driver' => 'session',
            'provider' => 'user',
        ],
    ],

    'providers' => [
        'admin' => [
            'driver' => 'eloquent',
            'model' => App\Model\Admin\Admin::class,
        ],
        'user' => [
            'driver' => 'eloquent',
            'model' => App\Model\User\User::class,
        ],
    ],

    'passwords' => [
        'admin' => [
            'provider' => 'admin',
            'table' => 'password_resets',
            'expire' => 60,
        ],
    ],

];
