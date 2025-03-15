<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Image Driver
    |--------------------------------------------------------------------------
    |
    | Intervention Image supports "GD Library" and "Imagick" to process images
    | internally. You may choose one of them according to your PHP
    | configuration. By default PHP's "GD Library" implementation is used.
    |
    | Supported: "gd", "imagick"
    |
    */

    'driver' => 'gd',

    // index size

    'index-image-sizes' => [
        'large' => [
            'width' => 800,
            'height' => 800
        ],
        'medium' => [
            'width' => 300,
            'height' => 300
        ],
        'small' => [
            'width' => 100,
            'height' => 100
        ],
    ],

    'default-current-index-image' => 'medium',

    // cache size

    'cache-image-sizes' => [
        'large' => [
            'width' => 800,
            'height' => 800
        ],
        'medium' => [
            'width' => 300,
            'height' => 300
        ],
        'small' => [
            'width' => 100,
            'height' => 100
        ],
    ],

    'default-current-cache-image' => 'medium',
    'image-cache-life-time' => 10,
    'image-not-found' => '',


];
