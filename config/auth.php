<?php

return [

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    'guards' => [
        'customer' => [
            'driver' => 'session',
            'provider' => 'customers', // Ensure 'customers' provider is defined correctly
        ],
        'service_provider' => [
            'driver' => 'session',
            'provider' => 'service_providers', // Ensure 'service_providers' provider is defined correctly
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
        'customers' => [ // Define the 'customers' provider correctly
            'driver' => 'eloquent',
            'model' => App\Models\Customer::class,
        ],
        'service_providers' => [ // Define the 'service_providers' provider correctly
            'driver' => 'eloquent',
            'model' => App\Models\ServiceProvider::class,
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
        ],
        'customers' => [ // Define the customers password reset configuration correctly
            'provider' => 'customers',
            'table' => 'password_resets',
            'expire' => 60,
        ],
    ],

    'password_timeout' => 10800,

];
