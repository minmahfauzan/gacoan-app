<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Broadcaster
    |--------------------------------------------------------------------------
    |
    | This option controls the default broadcaster that will be used by the
    | framework when broadcasting events. You may set this to any of the
    | drivers which have been configured in the array below.
    |
    | Supported: "reverb", "pusher", "redis", "log", "null"
    |
    */

    'default' => env('BROADCAST_CONNECTION', 'reverb'),

    /*
    |--------------------------------------------------------------------------
    | Broadcast Connections
    |--------------------------------------------------------------------------
    |
    | Here you may define all of the broadcast connections that will be used
    | to broadcast events to other services. Various drivers are available
    | for power-housing your real-time applications.
    |
    */

    'connections' => [

        'reverb' => [
            'driver' => 'reverb',
            'host' => env('REVERB_HOST'),
            'port' => env('REVERB_PORT'),
            'scheme' => env('REVERB_SCHEME', 'https'),
            'app_id' => env('REVERB_APP_ID'),
            'key' => env('REVERB_APP_KEY'),
            'secret' => env('REVERB_APP_SECRET'),
            'options' => [
                'cluster' => env('REVERB_APP_CLUSTER'),
                'encrypted' => true,
                'host' => env('REVERB_HOST') . ':' . env('REVERB_PORT'),
            ],
            'client_app_id' => env('REVERB_APP_ID'),
            'client_key' => env('REVERB_APP_KEY'),
        ],

        'pusher' => [
            'driver' => 'pusher',
            'key' => env('PUSHER_APP_KEY'),
            'secret' => env('PUSHER_APP_SECRET'),
            'app_id' => env('PUSHER_APP_ID'),
            'options' => [
                'cluster' => env('PUSHER_APP_CLUSTER'),
                'host' => env('PUSHER_HOST') ?: 'api-'.env('PUSHER_APP_CLUSTER', 'mt1').'.pusher.com',
                'port' => env('PUSHER_PORT', 443),
                'scheme' => env('PUSHER_SCHEME', 'https'),
                'encrypted' => true,
                'useTLS' => env('PUSHER_SCHEME', 'https') === 'https',
            ],
            'client_app_id' => env('PUSHER_APP_ID'),
            'client_key' => env('PUSHER_APP_KEY'),
        ],

        'redis' => [
            'driver' => 'redis',
            'connection' => 'default',
        ],

        'log' => [
            'driver' => 'log',
        ],

        'null' => [
            'driver' => 'null',
        ],

    ],

];
