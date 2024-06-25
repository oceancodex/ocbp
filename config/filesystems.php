<?php
use WPSP\Funcs;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => Funcs::instance()->env('FILESYSTEM_DRIVER', true, 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been set up for each driver as an example of the required values.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'public' => [
            'driver'     => 'local',
            'root'       => __DIR__ . '/../public',
            'url'        => Funcs::instance()->env('APP_URL', true) . '/core/storage',
            'visibility' => 'public',
            'throw'      => false,
        ],

        's3' => [
            'driver'                  => 's3',
            'key'                     => Funcs::instance()->env('AWS_ACCESS_KEY_ID', true),
            'secret'                  => Funcs::instance()->env('AWS_SECRET_ACCESS_KEY', true),
            'region'                  => Funcs::instance()->env('AWS_DEFAULT_REGION', true),
            'bucket'                  => Funcs::instance()->env('AWS_BUCKET', true),
            'url'                     => Funcs::instance()->env('AWS_URL', true),
            'endpoint'                => Funcs::instance()->env('AWS_ENDPOINT', true),
            'use_path_style_endpoint' => Funcs::instance()->env('AWS_USE_PATH_STYLE_ENDPOINT', true, false),
            'throw'                   => false,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
//        public_path('storage') => storage_path('app/public'),
    ],

];
